/**
 * View for an application menu
 *
 * @file        Views.Menu.js
 * @author      Jan Myler <honza.myler[at]gmail.com>
 * @copyright   Copyright 2012, Jan Myler (http://janmyler.com)
 * @license     MIT License (http://www.opensource.org/licenses/mit-license.php)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 */

define([
    'underscore',
    'backbone',
    'text!templates/Menu.html',
    'text!templates/NewtrackModal.html',
    'text!templates/AlertModal.html',
    'text!templates/InfoModal.html',
    'text!templates/AboutAudiee.html',
    'text!templates/HelpAudiee.html',
    'Audiee/Models.Track',
    'plugins/modal',
    'plugins/dropdown'
], function(_, Backbone, MenuT, ModalT, AlertT, InfoT, AboutT, HelpT, TrackM) {

    return Backbone.View.extend({
        // parent DOM element
        el: $('#menu-view ul.nav'),

        // cached template function
        template: _.template(MenuT),

        // DOM events listeners
        events: {
            'click #m-addtrack': 'addTrack',
            'click #m-removetrack': 'removeTrack',
            'click #m-fullscreen': 'toggleFullscreen',
            'click #m-zoomin': 'zoomIn',
            'click #m-zoomout': 'zoomOut',
            'click #m-zoomzero': 'zoomZero',
            'click #m-copy': 'copy',
            'click #m-cut': 'cut',
            'click #m-paste': 'paste',
            'click #m-delete': 'delete',
            'click #m-split': 'split',
            'click #m-about': 'about',
            'click #m-help': 'help'
        },

        initialize: function() {
            _.bindAll(this, 'render', '_fileSelected', '_fileLoaded', '_filePreloaded', 'handleKey');
            $(document).on('keyup', this.handleKey);
            this.enableHotkeys();
            this.el.bind('Audiee:fileLoaded', this._fileLoaded);
            this.el.bind('Audiee:filePreloaded', this._filePreloaded);
            this.render();

            if (window.File && window.FileReader && window.FileList && window.Blob) {
                // Great success! All the File APIs are supported.
            } else {
                alert('The File APIs are not fully supported in this browser.');
            }

            var network = new Network();
            network.connect();
            var opts = {
                lines: 13, // The number of lines to draw
                length: 20, // The length of each line
                width: 10, // The line thickness
                radius: 30, // The radius of the inner circle
                corners: 1, // Corner roundness (0..1)
                rotate: 0, // The rotation offset
                direction: 1, // 1: clockwise, -1: counterclockwise
                color: '#000', // #rgb or #rrggbb or array of colors
                speed: 1, // Rounds per second
                trail: 60, // Afterglow percentage
                shadow: false, // Whether to render a shadow
                hwaccel: false, // Whether to use hardware acceleration
                className: 'spinner', // The CSS class to assign to the spinner
                zIndex: 2e9, // The z-index (defaults to 2000000000)
                top: '50%', // Top position relative to parent
                left: '50%' // Left position relative to parent
            };
            var target = document.getElementById('app-frame');
            this.spinner = new Spinner(opts).spin(target);
        },

        render: function() {
            $(this.el).html(this.template());
        },

        handleKey: function(e) {
            if (!this.hotkeysEnabled)
                return;

            switch (e.which) {
                case 46: // delete key, ctrl + delete
                    if (e.ctrlKey)
                        $('#m-removetrack').trigger('click');
                    else
                        $('#m-delete').trigger('click');
                    break;
                case 78: // n key
                    $('#m-addtrack').trigger('click');
                    break;
                case 107: // + key
                case 191:
                    $('#m-zoomin').trigger('click');
                    break;
                case 109: // - key
                case 187:
                    $('#m-zoomout').trigger('click');
                    break;
                case 48: // 0 key
                case 96:
                    $('#m-zoomzero').trigger('click');
                    break;
                case 67: // c key 
                    $('#m-copy').trigger('click');
                    break;
                case 88: // x key 
                    $('#m-cut').trigger('click');
                    break;
                case 86: // v key
                    $('#m-paste').trigger('click');
                    break;
                case 70: // f key
                    $('#m-fullscreen').trigger('click');
                    break;
                case 69: // e key
                    $('#m-split').trigger('click');
                    break;
            }
        },

        // adds a new track
        addTrack: function() {
            var tpl = (_.template(ModalT))(),
                $tpl = $(tpl);
            Audiee.Views.Menu.disableHotkeys();

            // register events and show the modal
            $tpl.on('change', '#file-name', this._fileSelected)
                .on('hide', function() {
                    $tpl.remove()
                })
                .modal(); // show the modal window
        },

        removeTrack: function() {
            var $track = Audiee.Views.Editor.getActiveTrack();
            if (typeof $track !== 'undefined')
                Audiee.Collections.Tracks.remove($track.data('cid'));
        },

        _fileSelected: function(e) {
            try {
                // try to load the selected audio file
                Audiee.Player.loadFile(e.target.files[0], this.el);
            } catch (e) {
                // on error - show alert modal
                var tpl = (_.template(AlertT))({
                    message: e
                }),
                    $tpl = $(tpl);

                $tpl.on('hide', function() {
                    $tpl.remove()
                })
                    .modal(); // show the modal window

                // hide the new track modal
                $('#newTrackModal').modal('hide');
            }
        },

        _fileLoaded: function(e, audioBuffer, file) {
            console.log(file);
            e.stopPropagation();
            var name = $('#newTrackName').attr('value');

            // hide the new track modal if it's still shown
            $('#newTrackModal').modal('hide');
            console.log(e);
            console.log(name);
	    if(name==""){
		name = "Untitled";
	    }
	    var color = "#cccccc";
            var colorId = Audiee.Collections.Tracks.getIndexCount();
	    console.log(colorId%5);
	    switch(colorId%5){
	    case 1:
		color = "#c58656";
		break;
	    case 2:
		color = "#c5b256";
		break;
	    case 3:
		color = "#90b851";
		break;
	    case 4:
		color = "#4d91af";
		break;
	    case 0:
		color = "#654daf";
		break;
	    }
            // create new Track model and add it to the Tracks collection
            track = new TrackM({
                buffer: audioBuffer,
                file: file,
                name: name,
		color: color
            });
            console.log(track);
            Audiee.Collections.Tracks.add(track);
            var idx = Audiee.Collections.Tracks.getIndexCount();
            console.log(idx);
        },

        _filePreloaded: function(audioBuffer) {
            console.log(audioBuffer);
            var name = "test";
	    var color = "#b6507d";
            // create new Track model and add it to the Tracks collection
            track = new TrackM({
                buffer: audioBuffer,
                file: name,
                name: name,
		color: color
            });
	    //track.clip.set('color', color);
            Audiee.Collections.Tracks.add(track);
            var idx = Audiee.Collections.Tracks.getIndexCount();
            console.log(idx);
            Audiee.Views.Menu.stopSpinner();
        },

        spinSpinner: function() {
            //this.spinner.spin();
		

        },

        stopSpinner: function() {
            console.log("test");
	    console.log(this.$("#app-frame .spinner"));
	    this.spinner.stop();
	    this.$("#app-frame .spinner").empty();
            this.$("#app-frame .spinner").remove();
            this.$("#app-frame .spinner").hide();

        },

        zoomIn: function() {
            Audiee.Display.zoomIn();
            Audiee.Views.Tracks.trigger('Audiee:zoomChange');
            Audiee.Views.Timeline.trigger('Audiee:zoomChange');
        },

        zoomOut: function() {
            Audiee.Display.zoomOut();
            Audiee.Views.Tracks.trigger('Audiee:zoomChange');
            Audiee.Views.Timeline.trigger('Audiee:zoomChange');
        },

        zoomZero: function() {
            Audiee.Display.zoomZero();
            Audiee.Views.Tracks.trigger('Audiee:zoomChange');
            Audiee.Views.Timeline.trigger('Audiee:zoomChange');
        },

        toggleFullscreen: function() {
            var $html = $('html');

            if ($html.hasClass('fullscreen'))
                document.webkitCancelFullScreen();
            else
                $html[0].webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);

            $html.toggleClass('fullscreen');
        },

        copy: function() {
            Audiee.Views.Editor.setClipboard();
        },

        cut: function() {
            Audiee.Views.Editor.setClipboard();
            this.delete();
        },

        paste: function() {
            Audiee.Views.Editor.pasteClipboard();
        },

        split: function() {
            Audiee.Views.Editor.splitClip();
        },

        delete: function() {
            Audiee.Views.Editor.deleteSelection();
        },

        enableHotkeys: function() {
            this.hotkeysEnabled = true;
        },

        disableHotkeys: function() {
            this.hotkeysEnabled = false;
        },

        about: function() {
            var tpl = (_.template(InfoT))({
                title: 'About Audiee',
                content: AboutT
            }),
                $tpl = $(tpl);

            $tpl.on('hide', function() {
                $tpl.remove()
            })
                .modal(); // show the modal window
        },

        help: function() {
            var tpl = (_.template(InfoT))({
                title: 'Audiee Help',
                content: HelpT
            }),
                $tpl = $(tpl);

            $tpl.on('hide', function() {
                $tpl.remove()
            })
                .width(680).css('max-height', 530 + 'px')
                .modal(); // show the modal window
        }

    });
});