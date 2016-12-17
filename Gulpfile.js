// Require Node.js dependencies
var gulp = require('gulp');
var sass = require('gulp-sass');

// Compile SASS to CSS
gulp.task('styles', function() {
	gulp.src('assets/sass/*.scss')
	    .pipe(sass().on('error', sass.logError))
	    .pipe(gulp.dest('./public/static/'));
});

// Default task for Gulp
gulp.task('default', function() {
	// Watch for changes to SASS stylesheets
	gulp.watch('assets/sass/**/*.scss', ['styles']);
});

