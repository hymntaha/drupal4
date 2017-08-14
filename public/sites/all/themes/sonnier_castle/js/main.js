
;

(function($){


  $(function(){

    $("a[rel=external]").attr("target", "_blank");

    $('#site-design').click(function(event){
      event.preventDefault();
      if($('#site-design-link').css('display') == 'none'){
        $('#site-design-link').fadeIn();
      }
      else{
        $('#site-design-link').fadeOut();
      }
    });

    if($("#node-12").size() > 0){ //node-12 means contact page

        $(".form-required").remove();

      var placeholderSupport = ("placeholder" in document.createElement("input"));
        $("label").each(function(){
          var $this = $(this);
          var $input = $this.parent().find("input.form-text, textarea").attr("placeholder", $this.text());
          $input.data("placeholder-text", $this.text());
          $this.text("");
          if(!placeholderSupport){
            $input.bind("focus", function(){
              if($(this).val() != ""){
                $(this).parents(".form-item").find("span.placeholder").remove();
              }
            });
            $input.bind("change blur keyup", function(){
              $(this).parents(".form-item").find("span.placeholder").remove();
              if($(this).val() == ""){
                $(this).parents(".form-item").find("label").append($('<span class="placeholder"></span>').text($(this).data("placeholder-text")));
              }
            }).blur();

          }

        });
     }

    if($("#node-27").size() > 0){ //node-12 means survey page
      $(".form-required").remove();
      var placeholderSupport = ("placeholder" in document.createElement("input"));
      $(".form-text").each(function(){
        var $this = $(this);
        var $input = $this.parent().find("input.form-text, textarea").attr("placeholder", "Enter Text Here");
        $input.data("placeholder-text", "Enter Text Here");
        if(!placeholderSupport){
          $input.bind("focus", function(){
            if($(this).val() != ""){
              $(this).parents(".form-item").find("span.placeholder").remove();
            }
          });
          $input.bind("change blur keyup", function(){
            $(this).parents(".form-item").find("span.placeholder").remove();
            if($(this).val() == ""){
              $(this).parents(".form-item").find("label").append($('<span class="placeholder"></span>').text($(this).data("placeholder-text")));
            }
          }).blur();

        }

      });
    }

    if($('.shop-form').size() > 0){ 

      //$(".form-required").remove();

      var placeholderSupport = ("placeholder" in document.createElement("input"));
        $("label").each(function(){
          var $this = $(this);
          var $input = $this.parent().find("input.form-text, textarea").attr("placeholder", $this.text().replace('\*','(Required)'));
          $input.data("placeholder-text", $this.text());
          $this.text("");
          if(!placeholderSupport){
            $input.bind("focus", function(){
              if($(this).val() != ""){
                $(this).parents(".form-item").find("span.placeholder").remove();
              }
            });
            $input.bind("change blur keyup", function(){
              $(this).parents(".form-item").find("span.placeholder").remove();
              if($(this).val() == ""){
                $(this).parents(".form-item").find("label").append($('<span class="placeholder"></span>').text($(this).data("placeholder-text").replace('\*','(Required)')));
              }
            }).blur();

          }

        });
     }


  });

  Drupal.fullscreenImage = function(slide){

    var $slideshow = $(".slideshow");

    var $img = $(slide).find("img");


    var width = $slideshow.width();
    var height = $slideshow.height();

    if(width == 0 || height == 0){
      width = $(window).width();
      height = $(window).height();
    }

    var img_height = $img.height();
    var img_width = $img.width();

    var new_width = 0;
    var new_height = 0;
    var new_left = 0;
    var new_top = 0;

    var aspect = width/height;
    var img_aspect = img_width/img_height;
    if(aspect > img_aspect){ //wider aspect ratio, have to cut off top/bottom
      new_left = 0;
      new_width = width;
      new_height = new_width/img_aspect;
      new_top = 0;//-((new_height-height)/2);
    }else if(aspect < img_aspect){ //narrow aspect, have to cut off sides
      new_top = 0;
      new_height = height;
      new_width = new_height*img_aspect;
      new_left = -((new_width-width)/2);
    }else{
      new_width=width;
      new_height=height;
    }


    $img.css({
      width: new_width,
      height: new_height,
      left: new_left,
      top: new_top
    });





  };





})(jQuery);