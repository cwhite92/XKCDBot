var gulp = require('gulp');
var sass = require('gulp-sass');
var cssmin = require('gulp-cssmin');

gulp.task('scss', function() {
    return gulp.src('./scss/styles.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(cssmin())
        .pipe(gulp.dest('./public/css'));
});

gulp.task('watch', function() {
    gulp.watch('./scss/**/*.scss', ['scss']);
});

gulp.task('default', ['scss', 'watch']);