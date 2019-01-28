$(window).load(function() {
  $(".preloader-wrapper").fadeOut(0);
	$(".overlay").fadeOut(0)
});


$(document).ready(function() {
	$('.sidenav').sidenav();
	$('select').formSelect();
  $('.slider').slider();
  $('.parallax').parallax();
  $('.tabs').tabs();
  $('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    maxDate: new Date(),
    yearRange: [1950, (new Date()).getFullYear()]
  });
  $('.collapsible').collapsible();
  $('.modal').modal({ inDuration: 0, outDuration: 0 });
	$('.tooltipped').tooltip({ enterDelay: 50, exitDelay: 50 });
	$('.dropdown-trigger').dropdown({
    autoTrigger: true,
		constrainWidth: true,
		hover: false,
    coverTrigger: false
	});
  $('textarea#comment_content').characterCounter();

  $('#review_content').trigger('autoresize');
  $('#blog_content').trigger('autoresize');

  if($('#song_count').val()) {
    var song_counter = $('#song_count').val();
  } else {
    var song_counter = 1;
  }

  if($('#review_count').val()) {
    var review_counter = $('#review_count').val();
  } else {
    var review_counter = 1;
  }

  $("#toggleAdmin").click(function() {
    $('.admin_panel').toggleClass('transform-active');
  });

  $('#add').click(function() {
		song_counter++;
		$('#dynamic_field').append('<tr id="row' + song_counter + '"><td><input type="text" name="song_titles[]"/></td><td><input type="number" name="song_ratings[]" min="1" max="5" step="0.5" value="3.0"/></td><td><button style="padding: 0 1rem;" type="button" name="remove" id="' + song_counter + '" class="btn btn_remove red">X</button></td></tr>');
  });

  $('#addReview').click(function() {
    review_counter++;
		$('#sReviews').append('<div class="small_review row" id="review' + review_counter + '"><div class="small_review_delete"><a class="btn red btn_remove" id="' + review_counter + '"><i class="material-icons">clear</i></a></div><div class="input-field col s6"><label for="review_title">Album-/Track-Titel</label><input id="review_title" type="text" name="sReview_titles[]">\
                           </div><div class="input-field col s6"><label for="review_artist">Künstler</label><input id="review_artist" type="text" name="sReview_artists[]"></div><div class="input-field col s12"><label for="review_content">Reviewtext</label><textarea class="materialize-textarea" id="review_content" name="sReview_contents[]"></textarea>\
                           </div><div class="file-field input-field col s6"><div class="btn"><span>Cover hochladen</span><input type="file" name="sReview_imgs[]" id="review_img"></div><div class="file-path-wrapper"><input class="file-path validate" type="text"></div>\
                           </div><label class="rating_label">Bewertung</label><div class="rating col s6"><p class="range-field"><input type="range" min="1" max="5" step="0.1" name="sReview_ratings[]"/></p></div></div>');
  });

  $(document).on('click', '.btn_remove', function() {
    var button_id = $(this).attr("id");
    $('#review' + button_id + '').remove();
  });

  $(document).on('click', '.btn_remove', function() {
		var button_id = $(this).attr("id");
		$('#row' + button_id + '').remove();
  });

  if(typeof(CKEDITOR) !== "undefined") {
    CKEDITOR.on('instanceReady', function(ev) {
  	var editor = ev.editor;
   	var dataProcessor = editor.dataProcessor,
      htmlFilter = dataProcessor && dataProcessor.htmlFilter;
      htmlFilter.addRules({
        elements: {
          $: function(element) {
            var parent = element.parent;
            if(element.name == 'p') {
              if(parent && parent.name.toLowerCase()=='blockquote') {
                element.name=""
                parent.name='q';
              }
            }
            return element;
          }
        }
      });
  	});
  }
});


function closeGenre() {
  $('.genre_label').hide();
  var queryString = getUrlVars();
  if(queryString.length > 1) {
    window.location.href = '/reviews?' + queryString[0] + '=' + getUrlVars()['month'] + '&' + queryString[1] + '=' + getUrlVars()['year'];
  } else {
    window.location.href = '/reviews';
  }
}

function filterGenre(genre) {
  var queryString = getUrlVars();
  var urlPath = window.location.pathname;
  var split = urlPath.split('/');
  if(queryString.length > 1) {
    if(split[3] === 'genres') {
      window.location.href = genre + '?' + queryString[0] + '=' + getUrlVars()['month'] + '&' + queryString[1] + '=' + getUrlVars()['year'];
    } else {
      window.location.href = '/reviews/genres/' + genre + '?' + queryString[0] + '=' + getUrlVars()['month'] + '&' + queryString[1] + '=' + getUrlVars()['year'];
    }
  } else {
      window.location.href = '/reviews/genres/' + genre;
  }
}

function filterTag(tag) {
  var queryString = getUrlVars();
  var urlPath = window.location.pathname;
  var split = urlPath.split('/');
  if(queryString.length > 1) {
    if(split[3] === 'tags') {
      window.location.href = tag + '?' + queryString[0] + '=' + getUrlVars()['month'] + '&' + queryString[1] + '=' + getUrlVars()['year'];
    } else {
      window.location.href = '/blog/tags/' + tag + '?' + queryString[0] + '=' + getUrlVars()['month'] + '&' + queryString[1] + '=' + getUrlVars()['year'];
    }
  } else {
      window.location.href = '/blog/tags/' + tag;
  }
}

function closeDate() {
  $('.date_label').hide();
  var urlPath = window.location.pathname;
  var split = urlPath.split('/');
  if(split[2] === 'genres') {
    window.location.href = '/reviews/genres/' + split[3];
  } else {
    window.location.href = '/reviews';
  }
}

function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
