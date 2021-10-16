jQuery(document).ready(function($) {
    let stickyTop,
        stickyBottom,
        stickyCssTop,
        tabs = $('.tabs'),
        header = $('#wrapper__header'),
        body = $('#wrapper__body'),
        toTop = $('#toTop'),
        maxWidth = 576,
        lead = $('#lead.guideLead'),
        headerMenu = $('#headerMenu'),
        mediaMD = window.matchMedia('screen and (max-width: 1023px)')

    if(lead.length) {
        stickyTop = lead.children().first().offset().top
        stickyCssTop = parseInt(lead.children().first().css('top').replace('px', ''))
    }

    bulmaAccordion.attach()
    AOS.init({
        duration: 800,
        disable: function() {
            return window.innerWidth < maxWidth;
        }
    })

    if(document.getElementById('moto-accordions')) {
        let motoImage = $(document.getElementById('moto-accordion-image'))
        let firstAccordionImage = $(document.getElementById('moto-accordions')).find('.accordions article:first-child').attr('data-image')
        motoImage.attr('src', 'storage/' + firstAccordionImage)
        $(document.getElementById('moto-accordions')).find('article.accordion .accordion-header p, article.accordion .accordion-header .toggle').on('click', function() {
            motoImage.attr('src', 'storage/' + $(this).parent().parent().attr('data-image'))
        })
    }

    function clickHeaderMenu(e) {
        if (!e.matches) {
            $('[data-header-menu]').on('click', function (e) {
                e.preventDefault();
                let subject = `#${$(e.target).attr('data-header-menu')}`
                headerMenu.find('.header-menu.active').removeClass('active')
                if(headerMenu.toggleClass('show').hasClass('show')) {
                    headerMenu.find(subject).addClass('active')
                }
            })
        }
    }
    clickHeaderMenu(mediaMD)

    let vh = window.innerHeight * 0.01
    let vw = window.innerWidth * 0.01
    document.documentElement.style.setProperty('--vh', `${vh}px`)
    document.documentElement.style.setProperty('--vw', `${vw}px`)
    window.addEventListener('resize', () => {
        let vh = window.innerHeight * 0.01
        let vw = window.innerWidth * 0.01
        document.documentElement.style.setProperty('--vh', `${vh}px`)
        document.documentElement.style.setProperty('--vw', `${vw}px`)
    })

    let scrollTrigger = 100,
    toTopTrigger = 1200,
        Scroll = function () {
            let scrollTop = $(window).scrollTop()
            scrollTop > scrollTrigger ? header.addClass('scrolling') : header.removeClass('scrolling')
            scrollTop > toTopTrigger ? toTop.addClass('show') : toTop.removeClass('show')

            if(lead.length && stickyTop) {
                let pageYOffset = window.pageYOffset
                stickyBottom = lead.outerHeight() + stickyTop - stickyCssTop - lead.find('.card').outerHeight()
                pageYOffset >= stickyTop-stickyCssTop ? lead.children().first().addClass('sticky') : lead.children().first().removeClass('sticky')
                pageYOffset >= stickyBottom-25 ? lead.children().first().addClass('stop') : lead.children().first().removeClass('stop')
            }

            if(headerMenu.length && headerMenu.hasClass('show')) {
                headerMenu.removeClass('show')
                headerMenu.find('.header-menu.active').removeClass('active')
            }
        },
        ID = function () {
            return '_' + Math.random().toString(36).substr(2, 9);
        }
    Scroll();
    $(window).on('scroll', function () {
        Scroll()
    })
    toTop.on('click', function (e) {
        e.preventDefault()
        $('html, body').animate({
            scrollTop: 0
        }, '300')
    })

    $('.navbar-burger').on('click', function() {
        $('.navbar-burger').toggleClass('is-active');
        $('.navbar-start').toggleClass('is-active');
    });

    $('[data-typing]').each(function () {
        this.id = ID();
        let dataTarget = this.dataset.typing === '' ? '#' + this.id : '#' + this.id + ' ' + this.dataset.typing
        let sentence = $(this).find(this.dataset.typing).text()
        $(this).find(this.dataset.typing).text('')
        new Typed(dataTarget, {
            strings: ['', sentence, ''],
            typeSpeed: 90,
            loop: true,
            shuffle: false,
            smartBackspace: false,
            backDelay: 900,
            backSpeed: 90
        })
    })

    $('[data-target]').on('click', function (e) {
        if($(this).attr('data-target') !== 'car-modal-quote' && $(this).attr('data-target') !== 'motorcycle-modal-quote') {
            let __id = $(this).attr('data-target').replace('#', ''), __speed = $(this).attr('data-speed'), __indent = 0, __target = document.getElementById(__id)
            if($(this).attr('data-indent')) {
                __indent = $(this).attr('data-indent')
            }
            if(__target) {
                $('html, body').animate({
                    scrollTop: $(__target).offset().top - parseInt(__indent)
                }, __speed)
            }
        } else {
            body.toggleClass('modal-open')
            $('#' + $(this).attr('data-target')).addClass('is-active')
        }
    })

    $('.delete[aria-label="close"]').on('click', function () {
        $(this).parent().parent().parent().removeClass('is-active')
    })

    $('.owl-carousel').each(function () {
        let attr = eval("(" + $(this).attr('data-carousel') + ")")
        attr ? $(this).owlCarousel(attr) : $(this).owlCarousel()
        $(this).css({ 'opacity': 1 })
        AOS.refresh()
    })

    if(tabs.length) {
        let detailTabsEnabled = true
        tabs.each(function (keyTab, tab) {
            if(tab.id) {
                if(tab.id === 'multiTabs') {
                    $(tab).find('*.is-active').each(function (keyActive, active) {
                        $(document.getElementById(active.dataset.tab)).show()
                    })
                } else if (tab.dataset.autoplay && Boolean(tab.dataset.autoplay)) {
                    let ii
                    setInterval(function () {
                        if(detailTabsEnabled) {
                            let currentTab = $(tab).find('*.is-active')
                            currentTab.removeClass('is-active')
                            $(document.getElementById(currentTab[0].dataset.tab)).hide()
                            ii = currentTab.next().length ? currentTab.next() : $(currentTab.parent()[0].children[0])
                            ii.addClass('is-active')
                            $(document.getElementById(ii[0].dataset.tab)).show()
                        }
                    }, tab.dataset['autoplay-count'] ? tab.dataset['autoplay-count'] : 3000)
                }
            }
        })
        $('[data-tab] a').on('click', function (e) {
            let target = $(e.target), parentTab, tabLi, activeLi
            if(e.target.localName === 'h2' || e.target.localName === 'img') {
                parentTab = target.parent().parent().parent().parent();
                activeLi = target.parent().parent().parent().find('*.is-active')
                tabLi = target.parent().parent()
            } else {
                parentTab = target.parent().parent().parent()
                activeLi = target.parent().parent().find('*.is-active')
                tabLi = target.parent()
            }
            activeLi.removeClass('is-active')
            $(document.getElementById(activeLi.data().tab)).hide()
            tabLi.addClass('is-active')
            $(document.getElementById(tabLi.data().tab)).show()
            if(parentTab.length && parentTab[0].id && parentTab[0].id === 'detailTabs') {
                detailTabsEnabled = false
            }
        })
    }

    // function handleHeaderMenu() {
    //     if (window.innerWidth > 1024) {
    //         $('[data-header-menu]').on('click', function (e) {
    //             e.preventDefault();
    //             let subject = `#${$(e.target).attr('data-header-menu')}`
    //             headerMenu.find('.header-menu.active').removeClass('active')
    //             if(headerMenu.toggleClass('show').hasClass('show')) {
    //                 headerMenu.find(subject).addClass('active')
    //             }
    //         })
    //     }
    // }

    // window.addEventListener('resize', handleHeaderMenu);
})