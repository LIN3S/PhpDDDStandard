var gulp = require('gulp');
var chug = require('gulp-chug');
var argv = require('yargs').argv;

config = [
  '--rootPath',
  argv.rootPath || __dirname + '/assets/',
  '--nodeModulesPath',
  argv.nodeModulesPath || __dirname + '/node_modules/'
];

gulp.task('admin', function() {
  gulp.src('../../../../vendor/sylius/sylius/src/Sylius/Bundle/AdminBundle/Gulpfile.js', { read: false })
    .pipe(chug({ args: config }))
  ;
});
