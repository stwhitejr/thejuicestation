var sass = require('node-sass');
var fs = require('fs');
var exec = require('child_process').exec;

function compileSass(file) {
  const outFile = 'www/includes/' + file.replace(/scss/g, 'css');
  sass.render({
  file,
  sourceMap: true,
  outFile
  }, function(error, result) {

    if(!error) {
      fs.writeFile(outFile, result.css, function(err){
        if(!err){
          console.log('\n' + result.stats.entry + '\nsuccessfully compiled to\n' + outFile);
        } else {
          throw err;
        }
      });
    } else {
      throw error;
    }
  });
}

exec('git diff origin/master --name-only "scss/*.scss" ":(exclude)scss/core/*.scss"', function(err, stdout, stderr) {
  if (!err) {
    let filesToCompile = stdout.split('\n');
    filesToCompile.pop();
    filesToCompile.forEach(function(file) {
      compileSass(file);
    });
  }
});