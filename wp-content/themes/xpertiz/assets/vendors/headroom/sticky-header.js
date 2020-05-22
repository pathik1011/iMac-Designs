/* global Headroom, jQuery */

// export default () => {
  var $ = jQuery
  const header = jQuery('#header')
  if ( header.length !== 0 ) {
    const headerHeight = header.height()
    const headroom = new Headroom(header.get(0), {
      classes: {
        initial: 'sticky',
        pinned: 'sticky--pinned',
        unpinned: 'sticky--unpinned',
        top: 'sticky--top',
        notTop: 'sticky--not-top',
        bottom: 'sticky--bottom',
        notBottom: 'sticky--not-bottom'
      },
      // STILL ON INVESTIGATION
      onPin() {
        // console.log(headerHeight);
        if ( 82 !== headerHeight ) {
          jQuery('#page').css('padding-top', headerHeight)
        }
      },
      onTop() {
        // console.log(headerHeight);
        if ( 82 !== headerHeight ) {
          jQuery('#page').css('padding-top', headerHeight)
        }
        jQuery('body').removeClass('nav-sticky--not-top', headerHeight)
        jQuery('body').addClass('nav-sticky--top', headerHeight)
      },
      onNotTop() {
        jQuery('body').removeClass('nav-sticky--top', headerHeight)
        jQuery('body').addClass('nav-sticky--not-top', headerHeight)
      }
    })
    headroom.init()
  } // end if ( header )
