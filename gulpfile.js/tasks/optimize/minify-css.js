var config = require('../../config')
var gulp   = require('gulp')
var minify = require('gulp-minify-css')
var path   = require('path')
var uglify = require('gulp-uglify')

// 4) Rev and compress CSS and JS files (this is done after assets, so that if a
//    referenced asset hash changes, the parent hash will change as well
gulp.task('minify-css', function(){
  return gulp.src(path.join(config.root.dest,'/**/*.css'))
    .pipe(minify())
    .pipe(gulp.dest(config.root.dest))
})