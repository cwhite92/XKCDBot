var gulp = require('gulp');
var ts = require('gulp-typescript');
var mocha = require('gulp-mocha');

var tsProject = ts.createProject('tsconfig.json');

gulp.task('build', function() {
    return gulp.src('src/**/*.ts', {base: '.'})
        .pipe(ts(tsProject))
        .pipe(gulp.dest('.'));
});

gulp.task('test', ['build'], function() {
    return gulp.src('./test/**/*.ts', {base: '.'})
        .pipe(ts(tsProject))
        .pipe(gulp.dest('.'))
        .pipe(mocha({
            reporter: 'nyan',
            timeout: 10000
        }));
});

gulp.task('default', ['build']);