const gulp = require('gulp');
const autoprefixer = require('gulp-autoprefixer');
const cleanCSS = require('gulp-clean-css');
const browserSync = require('browser-sync').create();
const sourcemaps = require('gulp-sourcemaps');
const path = require('path');
const scss = require('gulp-sass');
const gcmq = require('gulp-group-css-media-queries');
const cssmin = require('gulp-cssmin');
const rename = require('gulp-rename')

/* gulp-group-css-media-queries */

const config = {
    src: './src',
    dest: './',
    stylesheets: {
        path: '/css',
        css: '/css/style.css',
        scss: '/css/*.scss'
    }
};

function buildStyleSheets(gulpSrc) {
    gulpSrc
        .pipe(gcmq())
        .pipe(sourcemaps.init())
        .pipe(autoprefixer({
            browsers: ['> 0.1%'],
            cascade: false
        }))
        .pipe(cleanCSS())
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(config.dest))
        .pipe(browserSync.reload({
            stream: true
        }));

    return buildMinCss();
}

function buildMinCss() {
    let gulpSrc = gulp.src(path.join(config.src, config.stylesheets.css));
    return gulpSrc
        .pipe(cssmin())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(config.dest));
}

gulp.task('build-css', function () {
    let gulpSrc = gulp.src(path.join(config.src, config.stylesheets.css))
    return buildStyleSheets(gulpSrc)
});

gulp.task('build-scss', function () {
    let gulpSrc = gulp.src(path.join(config.src, config.stylesheets.scss))
        .pipe(scss().on('error', scss.logError))
    return buildStyleSheets(gulpSrc)
});

gulp.task('watch', function () {
    browserSync.init({
        injectChanges: true,
        files: config.src,
        watch: true,
        proxy: {
            target: "http://dulyanich.com"
        }
    });

    // gulp.watch(config.src + config.stylesheets.css, gulp.series('build-css'));
    gulp.watch(config.src + config.stylesheets.scss, gulp.series('build-scss'));
});