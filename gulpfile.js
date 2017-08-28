var gulp = require('gulp');
var livereload = require('gulp-livereload')
var uglify = require('gulp-uglifyjs');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var imagemin = require('gulp-imagemin');
var pngquant = require('imagemin-pngquant');




gulp.task('imagemin', function () {
    return gulp.src('./themes/custom/racctheme/images/*')
        .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngquant()]
        }))
        .pipe(gulp.dest('./themes/custom/racctheme/images'));
});


gulp.task('sass', function () {
  gulp.src('./themes/custom/racctheme/sass/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({
        outputStyle: 'compressed',
        includePaths: ['node_modules/susy/sass']
    }).on('error', sass.logError))
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 7', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./themes/custom/racctheme/css'));
});

// gulp.task('sass', function() {
//     return gulp.src('scss/*.scss')
//         .pipe(sass({
//             outputStyle: 'compressed',
//             includePaths: ['node_modules/susy/sass']
//         }).on('error', sass.logError))
//         .pipe(gulp.dest('dist/css'));
// });


gulp.task('uglify', function() {
  gulp.src('./themes/custom/racctheme/lib/*.js')
    .pipe(uglify('raccjs.js'))
    .pipe(gulp.dest('./themes/custom/racctheme/js'))
});

gulp.task('watch', function(){
    livereload.listen();

    gulp.watch('./themes/custom/racctheme/sass/**/*.scss', ['sass']);
    gulp.watch('./themes/custom/racctheme/lib/*.js', ['uglify']);
    gulp.watch(['./themes/custom/racctheme/css/style.css', './themes/custom/racctheme/**/*.twig', './themes/custom/racctheme/js/*.js'], function (files){
        livereload.changed(files)
    });
});
