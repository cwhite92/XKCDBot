var gulp = require('gulp');
var ts = require('gulp-typescript');
var jasmine = require('gulp-jasmine');

var tsProject = ts.createProject('tsconfig.json');

gulp.task('build', function() {
    return gulp.src(['src/**/*.ts', 'typings/index.d.ts'], {base: '.'})
        .pipe(ts(tsProject))
        .pipe(gulp.dest('.'));
});

gulp.task('test', ['build'], function() {
    return gulp.src(['./test/**/*.ts', 'typings/index.d.ts'], {base: '.'})
        .pipe(ts(tsProject))
        .pipe(gulp.dest('.'))
        .pipe(jasmine());
});

gulp.task('default', ['build']);