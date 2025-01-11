module.exports = function(grunt) {
    grunt.initConfig({
      pkg: grunt.file.readJSON('package.json'),

      uglify: {
        build: {
          src: '*.js',
          dest: 'server.js'
        }
      }
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');

    // Definiere Standardaufgabe
    grunt.registerTask('default', ['uglify']);
  };
