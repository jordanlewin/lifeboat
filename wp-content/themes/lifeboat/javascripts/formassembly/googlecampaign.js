/* Google Campaign code */  
  
(function(){
  /* wait for GA tracking script to load and cookie to be set */
  
  if (!window.addEventListener) { window.addEventListener = function (type, listener, useCapture) { attachEvent('on' + type, function() { listener(event) }); }}

  window.addEventListener('load', function() {    
    var _utmz = {
      readCookie: function(name){
          var nameEQ = name + "=";
          var ca = document.cookie.split(';');
          for(var i=0;i < ca.length;i++) {
              var c = ca[i];
              while (c.charAt(0)==' ') c = c.substring(1,c.length);
              if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
          }
          return '';
      },
      getCampaignValues: function() {
          var r = {};
          try {
              var values = this.readCookie('__utmz');
              for(i=0;i<4;i++){
                values = values.substring(values.indexOf('.')+1);
              }              
              values = values.split('|'); 
              for (var i = 0; i < values.length; i++) {
                  r[values[i].split('=')[0]] = values[i].split('=')[1];
              }       
          } catch(x) { /* unexpected cookie format */ } 
          return r;
      },
      getSource: function() {
          var cv = this.getCampaignValues();
          return ('utmcsr' in cv)?cv['utmcsr']:'n/a';
      },
      getCampaign: function() {
          var cv = this.getCampaignValues();
          return ('utmccn' in cv)?cv['utmccn']:'n/a';
      },
      getMedium: function() {
          var cv = this.getCampaignValues();
          return ('utmcmd' in cv)?cv['utmcmd']:'n/a';
      },
      getKeyword: function() {
          var cv = this.getCampaignValues();
          return ('utmctr' in cv)?cv['utmctr']:'n/a';
      },
      getAdContent: function() {
          var cv = this.getCampaignValues();
          return ('utmcct' in cv)?cv['utmcct']:'n/a'
      },
      getGClId: function() {  
          var cv = this.getCampaignValues();
          return ('utmgclid' in cv)?cv['utmgclid']:null;    
      }
    };    
    try {
      if(!document.querySelector && base2) document.querySelector = base2.DOM.Element.querySelector;  
      var gaSource = document.querySelector('input.calc-GOOGLESOURCE');
       // if gclid is present (adword auto-tagging), source can be inferred to be 'google'.
      if(gaSource) gaSource.value = _utmz.getGClId()?'google':_utmz.getSource();

      var gaCampaign = document.querySelector('input.calc-GOOGLECAMPAIGN');
      if(gaCampaign) gaCampaign.value = _utmz.getCampaign();

      var gaMedium = document.querySelector('input.calc-GOOGLEMEDIUM');
       // if gclid is present (adword auto-tagging), medium can be inferred to be 'cpc'.
      if(gaMedium) gaMedium.value = _utmz.getGClId()?'cpc':_utmz.getMedium();

      var gaKeyword = document.querySelector('input.calc-GOOGLEKEYWORD');
      if(gaKeyword) gaKeyword.value = _utmz.getKeyword();

      var gaAdContent = document.querySelector('input.calc-GOOGLEADCONTENT');
      if(gaAdContent) gaAdContent.value = _utmz.getAdContent();

    } catch(x) { }
  }, false);
})();