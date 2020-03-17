const gulp = require('gulp');
const path = require('path');
const scss = require('gulp-sass');
const ts = require('gulp-typescript');
const cleanCSS = require('gulp-clean-css');
const sourcemaps = require('gulp-sourcemaps');
const autoprefixer = require('gulp-autoprefixer');
const tsProject = ts.createProject('tsconfig.json');
const gcmq = require('gulp-group-css-media-queries');
const browserSync = require('browser-sync').create();

const config = {
    src: './src',
    dest: 'dest',
    pages: {
        index: '/index.php'
    },
    stylesheets: {
        css: '/css/style.css',
        scss: '/css/style.scss'
    },
    scripts: {
        ts: '/ts/index.ts',
        php: '/php/*.php'
    },
    images: "/img/*.+(png|jpg|jpeg|gif|svg)"
};

function buildStyleSheets(gulpSrc) {
    return gulpSrc
        .pipe(gcmq())
        .pipe(sourcemaps.init())
        .pipe(cleanCSS())
        .pipe(autoprefixer({
            cascade: false
        }))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(config.dest))
        .pipe(browserSync.reload({
            stream: true
        }));
}

gulp.task('build-scss', () => {
    let gulpSrc = gulp.src(path.join(config.src, config.stylesheets.scss), {
            base: config.src
        })
        .pipe(scss().on('error', scss.logError))
    return buildStyleSheets(gulpSrc);
});

gulp.task('build-index', () => {
    return gulp.src(path.join(config.src, config.pages.index), {
            base: config.src
        })
        .pipe(gulp.dest(config.dest))
        .pipe(browserSync.reload({
            stream: true
        }));
})

gulp.task('build-img', () => {
    return gulp.src(path.join(config.src, config.images), {
        base: config.src
    })
    .pipe(gulp.dest(config.dest))
    .pipe(browserSync.reload({
        stream: true
    }));
})

gulp.task('compile-php', () => {
    return gulp.src(path.join(config.src, config.scripts.php), {
        base: config.src
    })
    .pipe(gulp.dest(config.dest))
    .pipe(browserSync.reload({
        stream: true
    }));
})

gulp.task('compile-ts', () => {
    return gulp.src(path.join(config.src, config.scripts.ts), {
            base: config.src
        })
        .pipe(tsProject())
        .pipe(gulp.dest(config.dest))
        .pipe(browserSync.reload({
            stream: true
        }));
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

    gulp.watch(config.src + config.stylesheets.scss, gulp.series('build-scss'));
    gulp.watch(config.src + config.images, gulp.series('build-img'));
    gulp.watch(config.src + config.pages.index, gulp.series('build-index'));
    gulp.watch(config.src + config.scripts.php, gulp.series('compile-php'));
    gulp.watch(config.src + config.scripts.ts, gulp.series('compile-ts'));
});