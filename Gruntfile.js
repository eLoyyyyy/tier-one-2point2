module.exports = function(grunt){
    
    grunt.initConfig({
        concat: {
            css: {
                src: ['css/*.css', '!css/*.min.css', '!css/style.css'],
                dest: 'css/style.css',
            },
            js: {
                src: ['js/*.js', '!js/*.min.js', '!js/scripts.js'],
                dest: 'js/scripts.js',
            },
        },
        watch: {
            js: {
                files: ['js/*.js', '!js/*.min.js', '!js/scripts.js'],
                tasks: ['concat:js', 'uglify'],
            },
            css: {
                files: ['css/*.css', '!css/*.min.css', '!css/style.css'],
                tasks: ['concat:css', 'cssmin'],
            },
        },
		uglify: {
			js: {
			  files: {
				'js/scripts.min.js': ['js/scripts.js']
			  }
			}
		},
		cssmin: {
			target: {
				files: {
				'css/style.min.css': ['css/style.css']
			  }
			}
		}
    });
  
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-uglify'); /* js */
	grunt.loadNpmTasks('grunt-contrib-cssmin'); /* css */
    grunt.registerTask('default', ['concat', 'watch', 'uglify', 'cssmin']);
    
};