var gulp = require("gulp");

/**
 *  front-end resource
 */
gulp.task('toAssets', function () {
    gulp.src('./node_modules/bootstrap/dist/**')                .pipe(gulp.dest("home/assets/bootstrap/"));
    gulp.src('./node_modules/jquery/dist/*')                    .pipe(gulp.dest("home/assets/jquery/"));
    gulp.src('./node_modules/jquery.cookie/jquery.cookie.js')   .pipe(gulp.dest("home/assets/jquery/"));
    gulp.src('./node_modules/font-awesome/css/**')              .pipe(gulp.dest("home/assets/font-awesome/css/"));
    gulp.src('./node_modules/font-awesome/fonts/**')            .pipe(gulp.dest("home/assets/font-awesome/fonts/"));
    gulp.src('./node_modules/font-awesome/fonts/**')            .pipe(gulp.dest("home/assets/font-awesome/fonts/"));
    gulp.src('./node_modules/d3/d3.js')                         .pipe(gulp.dest("home/assets/d3/"));
});

// --------------------------------------------------------------------------------

gulp.task('default', function() {
    gulp.run('toAssets');
});
