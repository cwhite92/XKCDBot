var gulp = require('gulp');
var ts = require('gulp-typescript');
var mocha = require('gulp-mocha');

// TODO: make this use tsconfig.json
// var tsProject = ts.createProject('tsconfig.json');

gulp.task('build', function() {
    return gulp.src('src/**/*.ts', {base: '.'})
        .pipe(ts({
            "target": "es6",
            "module": "commonjs",
            "moduleResolution": "node",
            "experimentalDecorators": true
        }))
        .pipe(gulp.dest('.'));
});

gulp.task('test', ['build'], function() {
    return gulp.src('./test/**/*.ts', {base: '.'})
        .pipe(ts({
            "target": "es6",
            "module": "commonjs",
            "moduleResolution": "node",
            "experimentalDecorators": true
        }))
        .pipe(gulp.dest('.'))
        .pipe(mocha({
            reporter: 'nyan',
            timeout: 10000
        }));
});

gulp.task('default', ['build']);