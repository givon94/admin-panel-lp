$( document ).ready(function() {

    const prefixURL = Math.floor(Math.random() * 1000) + 1;
    const baseURL = '../admin/api/database.json?' + prefixURL;

    let logo = document.querySelectorAll('.main-logo'),
        pageTitleMain = document.querySelector('title'),
        pageTitle = document.querySelector('meta[name="title"]'),
        pageDescr = document.querySelector('meta[name="description"]'),
        pageKeywords = document.querySelector('meta[name="keywords"]'),
        pageFavicon = document.querySelector('link[rel="icon"]'),
        pageOgTitle = document.querySelector('meta[property="og:title"]'),
        pageOgDescr = document.querySelector('meta[property="og:description"]'),
        pageOgAlt = document.querySelector('meta[property="og:image:alt"]'),
        pageOgUrl = document.querySelector('meta[property="og:url"]'),
        pageOgImg = document.querySelector('meta[property="og:image"]'),
        contactPhones = document.querySelectorAll('.contacts'),
        contactPhonesTopBar = document.querySelectorAll('.top-bar__contact'),
        questionsContacts = document.querySelector('.questions-contacts'),
        footerContacts = document.querySelector('.footer_contacts-content'),
        footerPhones = document.querySelector('.footer_contacts-item-phones'),
        thisPage = window.location.pathname,
        thisDomen = window.location.origin + '/';

    if (thisPage === '/') {
        thisPage = 'index';
    } else {
        thisPage = thisPage.slice(0,thisPage.indexOf(".html")).replace('/', '');
    }

    let thisDomenPage = thisDomen + thisPage + '.html';


    const getData = (url, callback, reject = console.error) => {
        const request = new XMLHttpRequest();

        request.open('GET', url);
        request.addEventListener('readystatechange', () => {
            if (request.readyState !== 4) return;

            if (request.status === 200) {
                callback(request.response);
            } else {
                reject(request.status);
            }
        });
        request.send();
    };


    getData(baseURL, (data) => {
        data = JSON.parse(data);
        meta = data.meta;
        contactsTopBar = data.contacts.filter((item) => item.topbar);
        scriptsLists = data.scripts.lists.filter((item) => item.enabled);
        scriptsOther = data.scripts.other.filter((item) => item.enabled);

        const metaData = meta.filter((item) => {
            return item.page === thisPage;
        });

        logoUpdate(data.logo);
        metaDataUpdate(metaData);
        contactsNumbers(data.contacts, contactPhones);
        contactsNumbers(contactsTopBar, contactPhonesTopBar);
        contactsEmail(data.email_contacts);
        questionsContactsInfo(data.adress, 'Наш адрес', 'adress');
        questionsContactsInfo(data.work, 'Время работы', 'work');
        pageFavicon.setAttribute("href", 'admin/img/upload/' + data.favicon);
        sriptsGTM(data.scripts.gtm);
        sriptsAdd(scriptsLists);
        sriptsAdd(scriptsOther);
    });

    //-Мета теги
    const metaDataUpdate = (meta) => {
        let title = meta[0].title,
            descr = meta[0].descr,
            keywords = meta[0].keywords,
            image = meta[0].image;
        pageTitleMain.innerHTML = title;
        pageTitle.setAttribute("content", title);
        pageDescr.setAttribute("content", descr);
        pageKeywords.setAttribute("content", keywords);
        pageOgTitle.setAttribute("content", title);
        pageOgDescr.setAttribute("content", descr);
        pageOgUrl.setAttribute("content", thisDomenPage);
        pageOgImg.setAttribute("content", thisDomen + 'admin/img/upload/' + image);
        pageOgAlt.setAttribute("content", title);
    };


    //-Логотип
    const logoUpdate = (image) => {
        logo.forEach(item=> {
            item.setAttribute("src", 'admin/img/upload/' + image);
        })
    }


    //-Телефонные номера
    const contactsNumbers = (contacts, el) => {
        for(i = 0; i < contacts.length; i++) {
            let phoneItem = document.createElement('div');
            phoneItem.classList.add('phone-number')
            let phoneItemNum =
                `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="20" height="20">
                    <use xlink:href="#icon-${contacts[i].operator}"></use>
                </svg>
                <a class='${contacts[i].operator}' href="tel:${contacts[i].num.replace(/[^+\d]/g,"")}">${contacts[i].num}</a>
            `;
            phoneItem.insertAdjacentHTML('beforeend', phoneItemNum);

            let phoneItemSeo = `
                <span itemprop="telephone">${contacts[i].num.replace(/[^+\d]/g,"")}</span>
            `;

            for(j = 0; j < contacts[i].messenger.length; j++) {
                let phoneItemMessenger =
                    `<svg class="icon-messenger" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="20" height="20">
                        <use xlink:href="#icon-${contacts[i].messenger[j]}"></use>
                    </svg>`
                phoneItem.insertAdjacentHTML('beforeend', phoneItemMessenger);
            }

            if(el === contactPhones) footerPhones.insertAdjacentHTML('beforeend', phoneItemSeo);

            el.forEach(item=> {
                item.insertAdjacentHTML('beforeend', phoneItem.outerHTML);
            })
        }
    };


    //-Email
    const contactsEmail = (email) => {
        if (email !== '') {
            let emailItem = `
            <div class="phone-number">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 44" width="20" height="20">
                    <use xlink:href="#icon-mail"></use>
                </svg>
                <a href="mailto:${email}">${email}</a>
            </div>
            `;
            let emailItemSeo = `
                <div class="footer_contacts-item"><span><b>Электронная почта: </b></span><br><span itemprop="email">${email}</span></div>
            `;

            contactPhones.forEach(item=> {
                item.insertAdjacentHTML('beforeend', emailItem);
            })

            footerContacts.insertAdjacentHTML('beforeend', emailItemSeo);
        }
    }


    //-Время работы и адрес
    const questionsContactsInfo = (info, title, prefix) => {
        if (info !== '') {
            prefix === 'adress' ? height = 27.61 : height = 20;

            let item = `
            <div class="questions-contacts-list">
                <h4 class="questions-subtitle">${title}:</h4>
                <div class="questions-${prefix}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 ${height}" width="20" height="${height}">
                        <use xlink:href="#icon-${prefix}"></use>
                    </svg>
                    <p>${info}</p>
                </div>
            </div>
            `
            questionsContacts.insertAdjacentHTML('beforeend', item);
        }
    }


    //-Скрипты
    const sriptsAdd = (scripts) => {
        if(scripts.length > 0) {
            scripts.forEach(item => {
                if(item.position === 'beforeend') {
                    $(item.tag).append(item.code)
                } else if(item.position === 'afterbegin') {
                    $(item.tag).prepend(item.code)
                }
            })
        }
    }


    //-GTM
    const sriptsGTM = (scripts) => {
        if(scripts.enabled) {
            $('head').prepend(scripts.code_head);
            $('body').append(scripts.code_body);
        }
    }

});
