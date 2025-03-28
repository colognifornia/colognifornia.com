/**
 * A simple Gulp 4 Starter Kit for modern web development.
 *
 * @package @jr-cologne/create-gulp-starter-kit
 * @author JR Cologne <kontakt@jr-cologne.de>
 * @copyright 2019 JR Cologne
 * @license https://github.com/jr-cologne/gulp-starter-kit/blob/master/LICENSE MIT
 * @version v0.10.11-beta
 * @link https://github.com/jr-cologne/gulp-starter-kit GitHub Repository
 * @link https://www.npmjs.com/package/@jr-cologne/create-gulp-starter-kit npm package site
 *
 * ________________________________________________________________________________
 *
 * gulpfile.js
 *
 * The gulp configuration file.
 *
 * Modified for use in colognifornia/colognifornia.com.
 *
 */

const gulp                    = require('gulp'),
    sourcemaps                = require('gulp-sourcemaps'),
    plumber                   = require('gulp-plumber'),
    sass                      = require('gulp-sass')(require('sass')),
    autoprefixer              = require('gulp-autoprefixer'),
    minifyCss                 = require('gulp-clean-css'),
    babel                     = require('gulp-babel'),
    webpack                   = require('webpack-stream'),
    uglify                    = require('gulp-uglify'),
    concat                    = require('gulp-concat'),
    imagemin                  = require('gulp-imagemin'),

    src_folder                = './resources/',
    src_assets_folder         = src_folder + 'assets/',
    dist_folder               = './public/',
    dist_assets_folder        = dist_folder + 'assets/',
    node_modules_folder       = './node_modules/',
    dist_node_modules_folder  = dist_folder + 'node_modules/',

    node_dependencies         = Object.keys(require('./package.json').dependencies || {});

gulp.task('sass', () => {
    return gulp.src([
        src_assets_folder + 'sass/**/*.sass',
        src_assets_folder + 'scss/**/*.scss'
    ])
        .pipe(sourcemaps.init())
        .pipe(plumber())
        .pipe(sass())
        .pipe(autoprefixer())
        .pipe(minifyCss())
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(dist_assets_folder + 'css'));
});

gulp.task('js', () => {
    return gulp.src([ src_assets_folder + 'js/**/*.js' ], { since: gulp.lastRun('js') })
        .pipe(plumber())
        .pipe(webpack({
            mode: 'production'
        }))
        .pipe(sourcemaps.init())
        .pipe(babel({
            presets: [ '@babel/env' ]
        }))
        .pipe(concat('main.js'))
        .pipe(uglify())
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(dist_assets_folder + 'js'));
});

gulp.task('images', () => {
    return gulp.src([ src_assets_folder + 'images/**/*.+(png|jpg|jpeg|gif|svg|ico)' ], { since: gulp.lastRun('images') })
        .pipe(plumber())
        .pipe(imagemin())
        .pipe(gulp.dest(dist_assets_folder + 'images'));
});

gulp.task('fonts', () => {
    return gulp.src([ src_assets_folder + 'fonts/**/*.+(eot|svg|ttf|woff|woff2)' ], { since: gulp.lastRun('fonts') })
        .pipe(gulp.dest(dist_assets_folder + 'fonts'));
});

gulp.task('vendor', () => {
    if (node_dependencies.length === 0) {
        return new Promise((resolve) => {
            console.log("No dependencies specified");
            resolve();
        });
    }

    return gulp.src(node_dependencies.map(dependency => node_modules_folder + dependency + '/**/*.*'), {
        base: node_modules_folder,
        since: gulp.lastRun('vendor')
    })
        .pipe(gulp.dest(dist_node_modules_folder));
});

gulp.task('build', gulp.series('sass', 'js', 'images', 'fonts', 'vendor'));

gulp.task('dev', gulp.series('sass', 'js'));

gulp.task('watch', () => {
    const watchImages = [
        src_assets_folder + 'images/**/*.+(png|jpg|jpeg|gif|svg|ico)',
    ];

    const watchFonts = [
        src_assets_folder + 'fonts/**/*.+(eot|svg|ttf|woff|woff2)',
    ];

    const watchVendor = [];

    node_dependencies.forEach(dependency => {
        watchVendor.push(node_modules_folder + dependency + '/**/*.*');
    });

    const watch = [
        src_assets_folder + 'sass/**/*.sass',
        src_assets_folder + 'scss/**/*.scss',
        src_assets_folder + 'js/**/*.js',
    ];

    gulp.watch(watch, gulp.series('dev'));
    gulp.watch(watchImages, gulp.series('images'));
    gulp.watch(watchFonts, gulp.series('fonts'));
    gulp.watch(watchVendor, gulp.series('vendor'));
});

gulp.task('default', gulp.series('build', 'watch'));
