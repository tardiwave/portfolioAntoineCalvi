/* COLOR CHANGEMENT */

let slidercolor = '#23FF00';
const mainColor = '#23FF00';
cookies = document.cookie.split(';');
cookies.forEach((cookie, index) => {
    splitedCookie = cookie.split('=');
    splitedCookie.forEach(split => {
        if(split.trim() === 'primarycolor'){
            slidercolor =splitedCookie[1].trim();
            document.documentElement.style.setProperty('--primary', slidercolor);
        }
    });
});
const gradientTab = [
    [168, 0, 255],
    [41, 65, 158],
    [44, 179, 189],
    [48, 223, 60],
    [49, 150, 133],
    [23, 41, 158],
    [255, 0, 180]
  ];
let cookieDate = new Date;
cookieDate.setDate(cookieDate.getDate() + 30);
const intervalColorChange = (left, right, gradientIndex1, gradientIndex2) =>{
    let medianecolor = 0;
    let medianecolorR = 0;
    let medianecolorG = 0;
    let medianecolorB = 0;
    let pourcentColorA = 0;
    let pourcentColorB = 0;
    pourcentColorA = (slidercolor-left) / right;
    pourcentColorB = 1-pourcentColorA;
    medianecolorR = Math.round(gradientTab[gradientIndex1][0]*pourcentColorB + gradientTab[gradientIndex2][0]*pourcentColorA);
    medianecolorG = Math.round(gradientTab[gradientIndex1][1]*pourcentColorB + gradientTab[gradientIndex2][1]*pourcentColorA);
    medianecolorB = Math.round(gradientTab[gradientIndex1][2]*pourcentColorB + gradientTab[gradientIndex2][2]*pourcentColorA);
    medianecolor = "rgb(" + medianecolorR + ", " +medianecolorG + ", " + medianecolorB + ")";
    document.documentElement.style.setProperty('--primary', medianecolor);
    document.cookie = `primarycolor=${medianecolor}; expires=${cookieDate}; path=/; SameSite=None; Secure`;
}
const footerChangeColorRange = (e) => {
    slidercolor = e.target.value;
    if((e.target.value >= 0)&&(e.target.value <= 16)) {
      intervalColorChange(0,17,0,1);
    }else if((e.target.value >= 17)&&(e.target.value <= 33)) {
      intervalColorChange(17,17,1,2);
    }else if((e.target.value >= 34)&&(e.target.value <= 49)) {
      intervalColorChange(34,17,2,3);
    }else if((e.target.value >= 50)&&(e.target.value <= 66)) {
      intervalColorChange(50,17,3,4);
    }else if((e.target.value >= 66)&&(e.target.value <= 83)) {
      intervalColorChange(66,17,4,5);
    }else if((e.target.value >= 83)&&(e.target.value <= 100)) {
      intervalColorChange(83,18,5,6);
    };
}
document.getElementById('footerChangeColorTextReset').addEventListener('click', () => {
  document.documentElement.style.setProperty('--primary', mainColor);
  document.cookie = `primarycolor=${mainColor}; expires=${cookieDate}; path=/; SameSite=None; Secure`;
})

const margin = 24;

/* LITTLE WINDOW SCROLL */

window.selectable = ( a, b ) => {
  if (typeof b === 'boolean' && !b) {
    a.setAttribute('unselectable', 'on');
    a.setAttribute('onselectstart', 'return false;');
  } else {
    if (a.hasAttribute('unselectable')) {
      a.removeAttribute('unselectable');
    }
    if (a.hasAttribute('onselectstart')) {
      a.removeAttribute('onselectstart');
    }
  }
}

/* ABOUT */

let aboutMousePositionX = null;
let aboutMousePositionY = null;

let aboutGrabScroll = false;
let aboutGrabWindow = false;
let aboutInitX = null
let aboutInitY = null
let aboutInitXScroll = null
let aboutInitYScroll = null


let aboutScrollable = document.getElementById('aboutScrollable');
let aboutContent = document.getElementById('aboutScrollableContent');
let aboutScrollBar = document.getElementById('aboutScrollBar');
let aboutTheScroll = document.getElementById('aboutScroll');

aboutTheScroll.addEventListener( 'mousedown', () => {
  aboutGrabScroll = true;
  selectable(document.body, false);
})

document.addEventListener( 'mouseup', () => {
  aboutGrabScroll = false;
  selectable(document.body, true);
})
let aboutDeltaScroll = null;
document.addEventListener('mousemove', e => {
  aboutMousePositionY = e.clientY;
  if (aboutGrabScroll) {
    if (aboutInitY === null) {
      aboutInitY = e.clientY
    };
    aboutDeltaScroll = ( e.clientY - aboutInitY ) * 100 / (aboutScrollBar.clientHeight - aboutTheScroll.clientHeight);
    if(aboutDeltaScroll <= 100 && aboutDeltaScroll >= 0){
      aboutScrollable.scrollTo(0, ( ( aboutDeltaScroll * (aboutContent.clientHeight - aboutScrollable.clientHeight + margin) ) / 100));
      aboutTheScroll.style.marginTop = `${e.clientY - aboutInitY}px`;
    }
  };
});
aboutScrollable.addEventListener('scroll', () => {
  let aboutMaxScroll = aboutContent.clientHeight - aboutScrollable.clientHeight + margin
  let aboutScrollPourcentage = aboutScrollable.scrollTop * 100 / aboutMaxScroll;
  let aboutScrollLevel = (aboutScrollPourcentage * aboutScrollBar.clientHeight / 100) - aboutTheScroll.clientHeight;
  if(aboutScrollLevel <= ( aboutScrollBar.clientHeight - aboutTheScroll.clientHeight ) && aboutScrollLevel >= 0){
    aboutTheScroll.style.marginTop = `${aboutScrollLevel}px`;
  }
});

/* LITTLE WINDOW GRAB */

let aboutHeader = document.getElementById('aboutTitle');
let aboutContainer = document.getElementById('about');

aboutHeader.addEventListener( 'mousedown', (e) => {
  aboutGrabWindow = true;
  aboutDeltaY = e.clientY;
  selectable(document.body, false);
})

document.addEventListener( 'mouseup', () => {
  aboutGrabWindow = false;
  selectable(document.body, true);
})
let aboutDeltaX = null;
let aboutDeltaY = null;
const aboutBottomWindowStart = 119;
const aboutLetftWindowStart = 22;
let aboutBottomWindow = aboutBottomWindowStart;
let aboutLetftWindow = aboutLetftWindowStart;

document.addEventListener('mousemove', e => {
  aboutMousePositionX = e.clientX;
  aboutDeltaY = e.clientY;
  if (aboutGrabWindow) {
    if (aboutInitYScroll === null) {
      aboutInitXScroll = e.clientX
      aboutInitYScroll = e.clientY
    };
    aboutDeltaX = ( e.clientX - aboutInitXScroll );
    aboutDeltaY = ( e.clientY - aboutInitYScroll );
    aboutBottomWindow = aboutBottomWindowStart - aboutDeltaY;
    aboutLetftWindow = aboutLetftWindowStart + aboutDeltaX;
    aboutContainer.style.left = `${aboutLetftWindow}px`;
    aboutContainer.style.bottom = `${aboutBottomWindow}px`;
  };
});

/* LITTLE WINDOW TOGGLE */

let aboutDisplayStatus = false;

const resetAbout = () => {
  aboutContainer.style.left = `${aboutLetftWindowStart}px`;
  aboutContainer.style.bottom = `${aboutBottomWindowStart}px`;
}

let aboutMenuButton = document.getElementById('aboutMenuButton');
let aboutMenuButtonMobile = document.getElementById('aboutMenuButtonMobile');
let menuBgAbout = document.getElementById('menuBgAbout');
let aboutHeaderButton = document.getElementById('aboutCrossContainer');

aboutMenuButton.addEventListener('click', () => {
  aboutDisplayStatus = !aboutDisplayStatus;
  if(!aboutDisplayStatus){
    resetAbout();
    aboutContainer.style.display = "none";
    menuBgAbout.style.display = "none";
  }else {
    aboutContainer.style.display = "block";
    menuBgAbout.style.display = "none";
    if(aboutContent.clientHeight >= aboutScrollable.clientHeight) {
      aboutScrollBar.style.display = 'block';
    };
  }
});
aboutMenuButtonMobile.addEventListener('click', () => {
  aboutDisplayStatus = !aboutDisplayStatus;
  if(!aboutDisplayStatus){
    resetAbout();
    aboutContainer.style.display = "none";
    menuBgAbout.style.display = "none";
  }else {
    aboutContainer.style.display = "block";
    menuBgAbout.style.display = "block";
    if(aboutContent.clientHeight >= aboutScrollable.clientHeight) {
      aboutScrollBar.style.display = 'block';
    };
  }
});
aboutHeaderButton.addEventListener('click', () => {
  aboutDisplayStatus = !aboutDisplayStatus;
  if(!aboutDisplayStatus){
    resetAbout();
    aboutContainer.style.display = "none";
    menuBgAbout.style.display = "none";
  }else {
    aboutContainer.style.display = "block";
    menuBgAbout.style.display = "none";
    if(aboutContent.clientHeight >= aboutScrollable.clientHeight) {
      aboutScrollBar.style.display = 'block';
    };
  }
});

/* CONTACT */

let contactMousePositionX = null;
let contactMousePositionY = null;

let contactGrabScroll = false;
let contactGrabWindow = false;
let contactInitX = null
let contactInitY = null
let contactInitXScroll = null
let contactInitYScroll = null


let contactScrollable = document.getElementById('contactScrollable');
let contactContent = document.getElementById('contactScrollableContent');
let contactScrollBar = document.getElementById('contactScrollBar');
let contactTheScroll = document.getElementById('contactScroll');

contactTheScroll.addEventListener( 'mousedown', () => {
  contactGrabScroll = true;
  selectable(document.body, false);
})

document.addEventListener( 'mouseup', () => {
  contactGrabScroll = false;
  selectable(document.body, true);
})
let contactDeltaScroll = null;
document.addEventListener('mousemove', e => {
  contactMousePositionY = e.clientY;
  if (contactGrabScroll) {
    if (contactInitY === null) {
      contactInitY = e.clientY
    };
    contactDeltaScroll = ( e.clientY - contactInitY ) * 100 / (contactScrollBar.clientHeight - contactTheScroll.clientHeight);
    if(contactDeltaScroll <= 100 && contactDeltaScroll >= 0){
      contactScrollable.scrollTo(0, ( ( contactDeltaScroll * (contactContent.clientHeight - contactScrollable.clientHeight + margin) ) / 100));
      contactTheScroll.style.marginTop = `${e.clientY - contactInitY}px`;
    }
  };
});
contactScrollable.addEventListener('scroll', () => {
  let contactMaxScroll = contactContent.clientHeight - contactScrollable.clientHeight + margin
  let contactScrollPourcentage = contactScrollable.scrollTop * 100 / contactMaxScroll;
  let contactScrollLevel = (contactScrollPourcentage * contactScrollBar.clientHeight / 100) - contactTheScroll.clientHeight;
  if(contactScrollLevel <= ( contactScrollBar.clientHeight - contactTheScroll.clientHeight ) && contactScrollLevel >= 0){
    contactTheScroll.style.marginTop = `${contactScrollLevel}px`;
  }
});

/* LITTLE WINDOW GRAB */

let contactHeader = document.getElementById('contactTitle');
let contactContainer = document.getElementById('contact');

contactHeader.addEventListener( 'mousedown', (e) => {
  contactGrabWindow = true;
  contactDeltaY = e.clientY;
  selectable(document.body, false);
})

document.addEventListener( 'mouseup', () => {
  contactGrabWindow = false;
  selectable(document.body, true);
})
let contactDeltaX = null;
let contactDeltaY = null;
const contactBottomWindowStart = 119;
const contactLetftWindowStart = 147;
let contactBottomWindow = contactBottomWindowStart;
let contactLetftWindow = contactLetftWindowStart;

document.addEventListener('mousemove', e => {
  contactMousePositionX = e.clientX;
  contactDeltaY = e.clientY;
  if (contactGrabWindow) {
    if (contactInitYScroll === null) {
      contactInitXScroll = e.clientX
      contactInitYScroll = e.clientY
    };
    contactDeltaX = ( e.clientX - contactInitXScroll );
    contactDeltaY = ( e.clientY - contactInitYScroll );
    contactBottomWindow = contactBottomWindowStart - contactDeltaY;
    contactLetftWindow = contactLetftWindowStart + contactDeltaX;
    contactContainer.style.left = `${contactLetftWindow}px`;
    contactContainer.style.bottom = `${contactBottomWindow}px`;
  };
});

/* LITTLE WINDOW TOGGLE */

let contactDisplayStatus = false;

const resetContact = () => {
  contactContainer.style.left = `${contactLetftWindowStart}px`;
  contactContainer.style.bottom = `${contactBottomWindowStart}px`;
}

let contactMenuButton = document.getElementById('contactMenuButton');
let contactMenuButtonMobile = document.getElementById('contactMenuButtonMobile');
let menuBgContact = document.getElementById('menuBgContact');
let contactHeaderButton = document.getElementById('contactCrossContainer');

contactMenuButton.addEventListener('click', () => {
  contactDisplayStatus = !contactDisplayStatus;
  if(!contactDisplayStatus){
    resetContact();
    contactContainer.style.display = "none";
    menuBgContact.style.display = "none";
  }else {
    contactContainer.style.display = "block";
    menuBgContact.style.display = "none";
    if(contactContent.clientHeight >= contactScrollable.clientHeight) {
      contactScrollBar.style.display = 'block';
    };
  }
});
contactMenuButtonMobile.addEventListener('click', () => {
  contactDisplayStatus = !contactDisplayStatus;
  if(!contactDisplayStatus){
    resetContact();
    contactContainer.style.display = "none";
    menuBgContact.style.display = "none";
  }else {
    contactContainer.style.display = "block";
    menuBgContact.style.display = "block";
    if(contactContent.clientHeight >= contactScrollable.clientHeight) {
      contactScrollBar.style.display = 'block';
    };
  }
});
contactHeaderButton.addEventListener('click', () => {
  contactDisplayStatus = !contactDisplayStatus;
  if(!contactDisplayStatus){
    resetContact();
    contactContainer.style.display = "none";
    menuBgContact.style.display = "none";
  }else {
    menuBgContact.style.display = "none";
    contactContainer.style.display = "block";
    if(contactContent.clientHeight >= contactScrollable.clientHeight) {
      contactScrollBar.style.display = 'block';
    };
  }
});

/* WINK */

let newsMousePositionX = null;
let newsMousePositionY = null;

let newsGrabScroll = false;
let newsGrabWindow = false;
let newsInitX = null
let newsInitY = null
let newsInitXScroll = null
let newsInitYScroll = null


let newsScrollable = document.getElementById('newsScrollable');
let newsContent = document.getElementById('newsScrollableContent');
let newsScrollBar = document.getElementById('newsScrollBar');
let newsTheScroll = document.getElementById('newsScroll');

newsTheScroll.addEventListener( 'mousedown', () => {
  newsGrabScroll = true;
  selectable(document.body, false);
})

document.addEventListener( 'mouseup', () => {
  newsGrabScroll = false;
  selectable(document.body, true);
})
let newsDeltaScroll = null;
document.addEventListener('mousemove', e => {
  newsMousePositionY = e.clientY;
  if (newsGrabScroll) {
    if (newsInitY === null) {
      newsInitY = e.clientY
    };
    newsDeltaScroll = ( e.clientY - newsInitY ) * 100 / (newsScrollBar.clientHeight - newsTheScroll.clientHeight);
    if(newsDeltaScroll <= 100 && newsDeltaScroll >= 0){
      newsScrollable.scrollTo(0, ( ( newsDeltaScroll * (newsContent.clientHeight - newsScrollable.clientHeight + margin) ) / 100));
      newsTheScroll.style.marginTop = `${e.clientY - newsInitY}px`;
    }
  };
});
newsScrollable.addEventListener('scroll', () => {
  let newsMaxScroll = newsContent.clientHeight - newsScrollable.clientHeight + margin
  let newsScrollPourcentage = newsScrollable.scrollTop * 100 / newsMaxScroll;
  let newsScrollLevel = (newsScrollPourcentage * newsScrollBar.clientHeight / 100) - newsTheScroll.clientHeight;
  if(newsScrollLevel <= ( newsScrollBar.clientHeight - newsTheScroll.clientHeight ) && newsScrollLevel >= 0){
    newsTheScroll.style.marginTop = `${newsScrollLevel}px`;
  }
});

/* LITTLE WINDOW GRAB */

let newsHeader = document.getElementById('newsTitle');
let newsContainer = document.getElementById('news');

newsHeader.addEventListener( 'mousedown', (e) => {
  newsGrabWindow = true;
  newsDeltaY = e.clientY;
  selectable(document.body, false);
})

document.addEventListener( 'mouseup', () => {
  newsGrabWindow = false;
  selectable(document.body, true);
})
let newsDeltaX = null;
let newsDeltaY = null;
const newsBottomWindowStart = 119;
const newsLetftWindowStart = 260;
let newsBottomWindow = newsBottomWindowStart;
let newsLetftWindow = newsLetftWindowStart;

document.addEventListener('mousemove', e => {
  newsMousePositionX = e.clientX;
  newsDeltaY = e.clientY;
  if (newsGrabWindow) {
    if (newsInitYScroll === null) {
      newsInitXScroll = e.clientX
      newsInitYScroll = e.clientY
    };
    newsDeltaX = ( e.clientX - newsInitXScroll );
    newsDeltaY = ( e.clientY - newsInitYScroll );
    newsBottomWindow = newsBottomWindowStart - newsDeltaY;
    newsLetftWindow = newsLetftWindowStart + newsDeltaX;
    newsContainer.style.left = `${newsLetftWindow}px`;
    newsContainer.style.bottom = `${newsBottomWindow}px`;
  };
});

/* LITTLE WINDOW TOGGLE */

let newsDisplayStatus = false;

const resetNews = () => {
  newsContainer.style.left = `${newsLetftWindowStart}px`;
  newsContainer.style.bottom = `${newsBottomWindowStart}px`;
}

let newsMenuButton = document.getElementById('newsMenuButton');
let newsMenuButtonMobile = document.getElementById('newsMenuButtonMobile');
let menuBgNews = document.getElementById('menuBgNews');
let newsHeaderButton = document.getElementById('newsCrossContainer');

newsMenuButton.addEventListener('click', () => {
  newsDisplayStatus = !newsDisplayStatus;
  if(!newsDisplayStatus){
    resetNews();
    newsContainer.style.display = "none";
    menuBgNews.style.display = "none";
  }else {
    newsContainer.style.display = "block";
    if(newsContent.clientHeight >= newsScrollable.clientHeight) {
      newsScrollBar.style.display = 'block';
      menuBgNews.style.display = "none";
    };
  }
});

newsMenuButtonMobile.addEventListener('click', () => {
  newsDisplayStatus = !newsDisplayStatus;
  if(!newsDisplayStatus){
    resetNews();
    newsContainer.style.display = "none";
    menuBgNews.style.display = "none";
  }else {
    newsContainer.style.display = "block";
    menuBgNews.style.display = "block";
    if(newsContent.clientHeight >= newsScrollable.clientHeight) {
      newsScrollBar.style.display = 'block';
    };
  }
});
newsHeaderButton.addEventListener('click', () => {
  newsDisplayStatus = !newsDisplayStatus;
  if(!newsDisplayStatus){
    resetNews();
    newsContainer.style.display = "none";
    menuBgNews.style.display = "none";
  }else {
    newsContainer.style.display = "block";
    menuBgNews.style.display = "none";
    if(newsContent.clientHeight >= newsScrollable.clientHeight) {
      newsScrollBar.style.display = 'block';
    };
  }
});

aboutContainer.addEventListener('click', () => {
  aboutContainer.style.zIndex = 3;
  contactContainer.style.zIndex = 2;
  newsContainer.style.zIndex = 2;
})
contactContainer.addEventListener('click', () => {
  aboutContainer.style.zIndex = 2;
  contactContainer.style.zIndex = 3;
  newsContainer.style.zIndex = 2;
})
newsContainer.addEventListener('click', () => {
  aboutContainer.style.zIndex = 2;
  contactContainer.style.zIndex = 2;
  newsContainer.style.zIndex = 3;
})

menuBgAbout.addEventListener('click', () => {
  resetAllModals();
})
menuBgContact.addEventListener('click', () => {
  resetAllModals();
})
menuBgNews.addEventListener('click', () => {
  resetAllModals();
})

let mobileMenuIsDisplayed = false;

let mobileMenu = document.getElementById('menu');
let menuBg = document.getElementById('menuBg');
let mobileMenuButton = document.getElementById('menuButton');
let menuCross = document.getElementById('menuCrossContainer');

menuBg.addEventListener('click', () => {
  mobileMenuIsDisplayed = false;
  mobileMenu.style.display = 'none';
  document.body.style.overflow = 'auto';
  menuBg.style.display = 'none';
  window.onscroll = () => {};
  resetAllModals();
})

menuCross.addEventListener('click', () => {
  mobileMenuIsDisplayed = false;
  mobileMenu.style.display = 'none';
  document.body.style.overflow = 'auto';
  menuBg.style.display = 'none';
  window.onscroll = () => {};
  resetAllModals();
})

mobileMenuButton.addEventListener('click', () => {
  mobileMenuIsDisplayed = !mobileMenuIsDisplayed;
  if(mobileMenuIsDisplayed){
    mobileMenu.style.display = 'block';
    menuBg.style.display = 'block';
    let pauseX=window.scrollX;
    let pauseY=window.scrollY;
    window.onscroll = () => { window.scrollTo(pauseX, pauseY); };
  }else{
    mobileMenu.style.display = 'none';
    menuBg.style.display = 'none';
    window.onscroll = () => {};
  }
  resetAllModals();
})

const resetAllModals = () => {
  contactMousePositionX = null;
  contactMousePositionY = null;

  contactGrabScroll = false;
  contactGrabWindow = false;
  contactInitX = null
  contactInitY = null
  contactInitXScroll = null
  contactInitYScroll = null

  newsMousePositionX = null;
  newsMousePositionY = null;

  newsGrabScroll = false;
  newsGrabWindow = false;
  newsInitX = null
  newsInitY = null
  newsInitXScroll = null
  newsInitYScroll = null

  aboutMousePositionX = null;
  aboutMousePositionY = null;

  aboutGrabScroll = false;
  aboutGrabWindow = false;
  aboutInitX = null
  aboutInitY = null
  aboutInitXScroll = null
  aboutInitYScroll = null

  newsDisplayStatus = false;
  aboutDisplayStatus = false;
  contactDisplayStatus = false;
  menuBgNews.style.display = "none";
  menuBgContact.style.display = "none";
  menuBgAbout.style.display = "none";

  contactContainer.style.display = "none";
  resetContact();
  aboutContainer.style.display = "none";
  resetAbout();
  newsContainer.style.display = "none";
  resetNews();
}