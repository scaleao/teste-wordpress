const gulp = require('gulp');

const sass = require('gulp-sass')(require('sass'))
sass.compiler = require('node-sass')

const concat = require("gulp-concat"),
    plumber = require("gulp-plumber"),
    autoprefixer = require("gulp-autoprefixer"),
    babel = require("gulp-babel"),
    minifyjs = require("gulp-uglify");

path_theme = "./wp-content/themes/teste-tray/";

gulp.task('default', watch)
gulp.task('sass', compileSass)

function uglify() {
    gulp
      .src(path_theme + "assets/js/source/home.js")
      .pipe(plumber())
      .pipe(babel({ presets: ["@babel/preset-env"] }))
      .pipe(concat("home.min.js"))
      .pipe(minifyjs())
      .pipe(gulp.dest(path_theme + "assets/js/"));
  
    gulp
      .src(path_theme + "assets/js/source/interna.js")
      .pipe(plumber())
      .pipe(babel({ presets: ["@babel/preset-env"] }))
      .pipe(concat("interna.min.js"))
      .pipe(minifyjs())
      .pipe(gulp.dest(path_theme + "assets/js/"));
  
    return gulp
      .src(path_theme + "assets/js/source/components.js")
      .pipe(plumber())
      .pipe(babel({ presets: ["@babel/preset-env"] }))
      .pipe(concat("components.min.js"))
      .pipe(minifyjs())
      .pipe(gulp.dest(path_theme + "assets/js/"));
}

function compileSass(){
    gulp
        .src(path_theme + "assets/scss/home.scss")
        .pipe(sass({
            outputStyle: "compressed"
        })).on("error", sass.logError)
        .pipe(gulp.dest(path_theme + "assets/css", { mode: "0777" }));
  
    gulp
        .src(path_theme + "assets/scss/interna.scss")
        .pipe(sass({
            outputStyle: "compressed"
        })).on("error", sass.logError)
        .pipe(gulp.dest(path_theme + "assets/css", { mode: "0777" }));

    return gulp
        .src(path_theme + "assets/scss/components.scss")
        .pipe(sass({
            outputStyle: "compressed"
        })).on("error", sass.logError)
        .pipe(gulp.dest(path_theme + "assets/css", { mode: "0777" }));
}

function watch(){
    gulp.watch(path_theme + "assets/scss/**/*.scss", compileSass);
    gulp.watch(path_theme + "assets/js/**/*.js", uglify);
}

exports.assets = gulp.series(compileSass, uglify);
exports.watch = gulp.series(exports.assets, watch);
exports.default = gulp.series(exports.watch);