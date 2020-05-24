'use strict';

console.log('User: ', User);


const init = {
    method: 'GET',
    headers: new Headers({
        Accept: 'application/json',
        'Content-Type': 'application/json',
    }),
    body: {},
};

// const $store = document.getElementById('store');

document.getElementById('store')
    .addEventListener('change', event => {
        event.preventDefault();
        setStore(event.target.value);
    });


async function setStore(store) {
    init.body = JSON.stringify({
        currentStore: store,
    });
    const Store = await jsonFetch(init);
    console.log('Store: ', Store);
}

async function jsonFetch(init) {
    const response = await fetch(api, init).catch(error => console.error(error));
    const json = await response.json();
    const obj = JSON.parse(json);
    return obj;
}



function get(request) {
    const url = `${api}/${request}`;
    const init = {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        },
    };
    return fetch(url, init).catch(error => console.error(error));
}

function post(body) {
    const init = {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: body,
    };
    return fetch(api, init).catch(error => console.error(error));
}






















// let gtCloseDate = $('#gtCloseDate')
// let ltCloseDate = $('#ltCloseDate')

// let today = new Date()
// let sixMonthEarlier = new Date()
// sixMonthEarlier.setMonth(sixMonthEarlier.getMonth() - 6)

// let browserToday = getFormattedDate(today).browser
// let browserSixMonthEarlier = getFormattedDate(sixMonthEarlier).browser
// ltCloseDate.val(browserToday)
// gtCloseDate.attr('max', browserToday)
// ltCloseDate.attr('max', browserToday)
// gtCloseDate.attr('min', browserSixMonthEarlier)
// ltCloseDate.attr('min', browserSixMonthEarlier)


// $('input[type="date"]').on('change', (event) => {
//     let inputDate = new Date(event.target.value)
//     switch (event.target.id) {
//         case 'gtCloseDate':
//             // inputDate.setMonth( inputDate.getMonth() + 1)
//             let monthPlus = new Date(event.target.value)
//             monthPlus.setMonth(monthPlus.getMonth() + 1)
//             if (monthPlus >= today) {
//                 ltCloseDate.val(getFormattedDate(today).browser)
//             }
//             if (new Date(ltCloseDate.val()) >= monthPlus || new Date(ltCloseDate.val()) <= inputDate) {
//                 ltCloseDate.val(getFormattedDate(monthPlus).browser)
//             }
//             break
//         case 'ltCloseDate':
//             // inputDate.setMonth( inputDate.getMonth() - 1)
//             let monthMinus = new Date(event.target.value)
//             monthMinus.setMonth(monthMinus.getMonth() - 1)
//             if (monthMinus <= sixMonthEarlier) {
//                 gtCloseDate.val(getFormattedDate(sixMonthEarlier).browser)
//             }
//             if (new Date(gtCloseDate.val()) <= monthMinus || new Date(gtCloseDate.val()) >= inputDate || !gtCloseDate.val()) {
//                 gtCloseDate.val(getFormattedDate(monthMinus).browser)
//             }
//             break
//     }
//     client.gtCloseDate = getFormattedDate(new Date(gtCloseDate.val())).evotor
//     client.ltCloseDate = getFormattedDate(new Date(ltCloseDate.val())).evotor
// })
// ltCloseDate.change()

// function getFormattedDate(date) {
//     let YYYY = date.getFullYear()
//     let DD = (date.getDate() < 10) ? '0' + date.getDate() : date.getDate()
//     let MM = ((date.getMonth() + 1) < 10) ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1)
//     // let timeZone = '%2B' + date.toTimeString().split('GMT+')[1].split(' ')[0]
//     let timeZone = date.toTimeString().split('GMT')[1].split(' ')[0]
//     return {
//         "browser": `${YYYY}-${MM}-${DD}`,
//         "evotor": `${YYYY}-${DD}-${MM}T00:00:00.000${timeZone}`
//     }
// }







// let store = $('#store')
// store.on('change', () => {
//     client.currentStore = store.val()
// })
// // store.change()

// $('body').on('click', 'button', event => {
//     event.preventDefault()
//     let button = event.target
//     let name = button.name
//     let value = button.value
//     let parent = button.parentElement
//     switch (name) {
//         case 'page':
//             if ($(button).hasClass('tab_btn_active')) {
//                 return
//             } else {
//                 $('.tab_btn.tab_btn_active').removeClass('tab_btn_active')
//                 $('.tab_content.tab_content_active').fadeOut(0).removeClass('tab_content_active')
//                 $(button).addClass('tab_btn_active')
//                 $(`#${value}`).fadeIn().addClass('tab_content_active')
//                 console.log('Страница:  ', value) ////////////////////////////////////////////////////////////////////////////////
//             }
//             break
//         case 'form':
//             sendForm(parent)
//             break
//         case 'mgmt':
//             console.log('Кнопка:  ', value) ///////////////////////////////////////////////////////////////////////////////////////
//             break
//         case 'tpl':
//             // template(value)
//             console.log('Шаблон документа') ////////////////////////////////////////////////////////////////////////////////////////
//             break

//         default:
//             console.log('Неизвестная природе кнопка!!!') //////////////////////////////////////////////////////////////////////////////
//             break
//     }
// })

// function sendForm(form) {
//     let formData = new FormData(form)
//     for (let key in client) {
//         formData.append(key, client[key])
//     }
//     formData.forEach((value, key) => {
//         console.log(key, value)
//     })
//     // return /////////////////////////////////////////////////////////////////////////////////////////////////////////////
//     if (formData.get('operation') == 'delete') {
//         alert('Будут удалены все товары, у которых заполнено поле "uuid"')
//     }
//     postRequest(formData)
// }


// async function postRequest(body) {
//     let request = new Request('/', {
//         method: 'POST',
//         // mode:  'same-origin',// 'no-cors', 'cors',
//         // credentials: 'same-origin', //'omit',  'include',
//         body: body
//     })

//     let response = await fetch(request)

//     let headers = await response.clone().headers
//     headers.forEach((value, name) => {
//         console.log(`${name}: ${value}`)
//     })

//     switch (headers.get('Content-Type')) {
//         case 'text/html':
//         case 'text/html; charset=UTF-8':
//             let text = await response.clone().text()
//             console.log(text)
//             break
//         case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
//         case 'application/vnd.ms-excel':
//         case 'text/csv;charset=UTF-8':
//             // let fileName = headers.get('content-disposition') ? headers.get('content-disposition').split('filename=')[1] : 'undefined'
//             let fileName = headers.get('content-disposition').split('filename=')[1]

//             console.log(fileName)

//             let file = await response.blob()
//             const url = URL.createObjectURL(file)
//             let link = document.createElement('a')
//             link.href = url
//             link.download = fileName
//             link.click()
//             iframe.src = url // ??????????????????????????
//             setTimeout(() => URL.revokeObjectURL(url), 1000);
//             break

//         default:
//             console.log('postRequest(error): Content-Type unknown or undefined')
//             break
//     }

// }

// $('#testButton').on('click', () => {
//     let store = '20180815-B8DB-4075-8092-3D4BEF0AAB1F'
//     let device = 'deviceUuid=20180815-2EBC-404C-80DA-9A6A18C2F4AE'
//     let gtCloseDate = 'gtCloseDate=2019-01-06T09:00:00.000%2B1000' // %2B+1000
//     let ltCloseDate = 'ltCloseDate=2019-02-06T23:00:00.000%2B1000' // %2B+1000
//     let types = 'types=OPEN_SESSION'
//     let API = 'https://api.evotor.ru/api/v1/inventories'
//     let url = `${API}/stores/${store}/documents?${device}&${ltCloseDate}&${gtCloseDate}&${types}`
//     // url = 'https://api.evotor.ru/api/v1/inventories/stores/search'
//     // url = 'https://api.evotor.ru/api/v1/inventories/employees/search'
//     url = 'https://api.evotor.ru/api/v1/inventories/devices/search'
//     // url = `${API}/stores/${store}/documents?${device}`


//     fetch(url, {
//             method: 'GET',
//             headers: {
//                 // mode: 'cors', // 'same-origin','no-cors', 'cors',
//                 // 'credentials': 'include', // 'same-origin', 'omit',  'include',
//                 'X-Authorization': 'f13362e9-3cb9-49af-b621-97682e79bc49',
//                 // 'Authorization': 'f13362e9-3cb9-49af-b621-97682e79bc49'
//             }
//         })
//         .then(response => response.json())
//         .then(json => console.log(json))
//     // .then( response => response.text())
//     // .then( text => console.log(text))
// })



// function testAPIv2(argument) {
// 	let storeId = '20180815-B8DB-4075-8092-3D4BEF0AAB1F'
// 	let deviceId = '20180815-2EBC-404C-80DA-9A6A18C2F4AE'
// 	// let beginDate = 	'gtCloseDate=2019-12-06T09:00:00.000%2B1000'
// 	// let endDate = 		'ltCloseDate=2019-12-06T23:00:00.000%2B1000'
// 	let types = 'types=OPEN_SESSION'
// 	let url = `https://api.evotor.ru/api/v1/inventories/stores/${store}/documents?${device}&${endDate}&${beginDate}&${types}`
// 	// url = 'https://api.evotor.ru/api/v1/inventories/stores/search'
// 	// url = 'https://api.evotor.ru/api/v1/inventories/employees/search'
// 	// url = 'https://api.evotor.ru/api/v1/inventories/devices/search'
// 	let evotorAPI = 'https://api.evotor.ru'
// 	url = `${evotorAPI}/stores`
// 	url = `${evotorAPI}/devices`

// 	url = `${evotorAPI}/stores/${storeId}/documents` // работает
// 	url = `${evotorAPI}/stores/${storeId}/devices/${deviceId}/documents` //

// 	url = `${evotorAPI}/stores/${storeId}/product-groups` //
// 	url = `${evotorAPI}/stores/${storeId}/products` // работает

// 	fetch(url, {
// 		method: 'GET',
// 		headers: {
// 			// mode: 'cors', // 'same-origin','no-cors', 'cors',
// 			// 'credentials': 'include', // 'same-origin', 'omit',  'include',
// 			'Accept': 'application/vnd.evotor.v2+json',
// 			// 'Content-Type': 'application/vnd.evotor.v2+json',
// 			// 'Content-Type': 'application/vnd.evotor.v2+bulk+json',
// 			// 'X-Authorization': 'f13362e9-3cb9-49af-b621-97682e79bc49',
// 			'Authorization': 'f13362e9-3cb9-49af-b621-97682e79bc49'
// 		}
// 	})
// 	.then( response => response.json())
// 	.then( json => console.log(json))
// 	// .then( response => response.text())
// 	// .then( text => console.log(text))
// }














// function test() {


//     let userId = location.search.split('userId=')[1].split('&')[0]
//     let token = location.search.split('token=')[1].split('&')[0]
//     // console.log(userId, token)

//     let store = $('#store'),
//         storeUuid
//     store.on('change', () => {
//         storeUuid = store.val()
//     })
//     store.change()

//     let device = $('#device'),
//         deviceUuid
//     device.on('change', () => {
//         deviceUuid = device.val()
//     })
//     device.change()

//     // Служебные отладочные блоки:
//     let divFrame = $('#divFrame'),
//         iframe = $('#iframe')

//     $('body').on('click', 'button', event => {
//         // console.log('event:  ', event)
//         event.preventDefault()
//         let button = event.target
//         let name = button.name
//         let value = button.value
//         let parent = button.parentElement
//         switch (name) {
//             case 'page':
//                 // $('#main').load(`main/${value}.php`)
//                 if ($(button).hasClass('tab_btn_active')) {
//                     return
//                 } else {
//                     $('.tab_btn.tab_btn_active').removeClass('tab_btn_active')
//                     $('.tab_content.tab_content_active').fadeOut(0).removeClass('tab_content_active')
//                     $(button).addClass('tab_btn_active')
//                     $(`#${value}`).fadeIn().addClass('tab_content_active')
//                     console.log('Страница:  ', value)
//                 }
//                 break
//             case 'form':
//                 postRequest(parent)
//                 console.log('Форма:  ', parent)
//                 break
//             case 'mgmt':
//                 console.log('Кнопка:  ', value)
//                 break
//             case 'tpl':
//                 template(value)
//                 console.log('Шаблон документа')
//                 break

//             default:
//                 console.log('Неизвестная природе кнопка!!!')
//                 break
//         }
//     })

//     async function postRequest(form) {
//         let body = new FormData(form)
//         body.append("userId", userId)
//         body.append("token", token)
//         body.append("storeUuid", storeUuid)
//         body.append("formName", form.name)
//         let request = new Request('logic/forms.php', {
//             method: 'POST',
//             // mode:  'same-origin',// 'no-cors', 'cors',
//             // credentials: 'same-origin', //'omit',  'include',
//             body: body
//         })
//         let response = await fetch(request)
//         switch (form.name) {
//             case 'productsUpload':
//                 let text = await response.clone().text()
//                 console.log(text)
//                 break
//             case 'productsDownload':
//                 let headers = await response.clone().headers
//                 headers.forEach((value, name) => {
//                     console.log(`${name}: ${value}`)
//                 })
//                 let fileName = headers.get('content-disposition') ? headers.get('content-disposition').split('filename=')[1] : 'undefined'
//                 console.log(fileName)
//                 let file = await response.blob()
//                 const url = URL.createObjectURL(file)
//                 let link = document.createElement('a')
//                 link.href = url
//                 link.download = fileName
//                 link.click()
//                 iframe.src = url // ???????????????
//                 setTimeout(() => URL.revokeObjectURL(url), 1000);
//                 break

//             default:
//                 console.log('postRequest error')
//                 break
//         }
//     }

//     function template(ext) {
//         let link = document.createElement('a')
//         link.href = `api/templates/productsTemplate.${ext}`
//         link.download = `productsTemplate.${ext}`
//         link.click()
//         link.remove()
//     }

// }



/*
$('button').prop('disabled', true);

// const uuid = '01-000000001397790';
// const token = 'b49f9304-ac81-4ed4-918a-a6b137b2cafa';
// const uuid = location.search.split('?')[1].split('&')[0].split('=')[1];
// const token = location.search.split('?')[1].split('&')[1].split('=')[1];

let store = $('#store');
let storeUuid;
let	docApi,	prodApi, prodDelApi;

const	evotorApi = 		'https://api.evotor.ru/api/v1/inventories',
            emplApi =				`${evotorApi}/employees/search`,// GET
            devApi =				`${evotorApi}/devices/search`,// GET
            storesApi =			`${evotorApi}/stores`,// GET
            storSearchApi =	`${storesApi}/search`;// GET

const uuid = location.search.split('uuid=')[1].split('&')[0];
const token = location.search.split('token=')[1].split('&')[0];

const headersEv = new Headers({
    // 'Content-Type': 'application/vnd.evotor.v2+bulk+json',
    'Content-Type': 'application/vnd.evotor.v2+json',
    // 'Content-Type': 'multipart/form-data',
    'X-Authorization': token
});

let getInit = {
                                method: 'GET',
                                headers: headersEv,
};

let postInitEv = postInitEvSet;
function postInitEvSet(body = '') {
    let init = {
                                method: 'POST',
                                headers: headersEv,
                                body: body
                            };
    return init;
}

let postInitMy = postInitMySet;
function postInitMySet(body = '') {
    let headers = new Headers({
        // 'Content-Type': 'application/x-www-form-urlencoded',
        // 'Content-Type': 'multipart/form-data',
        'Content-Type': 'application/json;charset=utf-8',
        'X-User': uuid,
        // 'X-Token': token,
        'X-Store': storeUuid
    });
    let init = {
                                method: 'POST',
                                headers: headers,
                                body: body
                            };
    return init;
}


fetch(storSearchApi, getInit)
.then(response => response.json())
.then(json => { let stores = json;
    for (let i=0; i<stores.length; i++){
        store.append(`<option value = ${stores[i]['uuid']}>${stores[i]['name']}   ${stores[i]['address']}`);
    }
    store.on('change', () => {
        storeUuid = store.val()
        api()
    })
    store.trigger('change')
    $(document).on('click', 'button', event => buttonClick(event))
    $('button').prop('disabled', false)
}).catch(error => console.log(error));

function api(){
    docApi =			`${storesApi}/${storeUuid}/documents`;
    prodApi =			`${storesApi}/${storeUuid}/products`;
    prodDelApi =	`${storesApi}/${storeUuid}/products/delete`;
}

function buttonClick(event) {
    let name = event.target.name
    let value = event.target.value
    switch(name){
        case 'page':
            $('main').load(`main/${value}.php`);
            break;
        case 'template':
            console.log('Шаблон документа');
            // $('main').load('main/'+event.target.value+'.php');
            break;
        case 'prodDl':
            getProducts();
            break;

        default:
         console.log('Неизвестная природе кнопка!!!');
         break;
    }
};

function getProducts() {
    fetch(`${storesApi}/${storeUuid}/products`, getInit)
    .then(response => response.json())
    .then(json => { // Obj Array
        let body = JSON.stringify(json);
        // let body = json;
            // console.log(typeof body);
        fetch('logic/csv.php', postInitMy(body))
        .then(response => response.text())
        // .then(text => $.get(text))
        .then(text => {
            // console.log(text)
// работает:
            // const url = URL.createObjectURL(blob)
            let link = document.createElement('a')
            link.href = text
            link.download=''
            link.click()
            // setTimeout( () => URL.revokeObjectURL(url), 1000);
        })

// тоже работает:
            // const url = window.URL.createObjectURL(blob)
            // let link = document.createElement('a')
            // link.href = url;
            // link.download = 'filename.csv'
            // // link.download = blob.headers.get('content-disposition').split('filename=')[1]
            // link.click()
            // setTimeout( () => window.URL.revokeObjectURL(url), 1000);
        // })

        // .then(response => response.blob())
        // .then(blob => {
        // 	console.log(blob)
        // 	console.log(blob.headers)

        // .then(response => response.json())
        // .then(json => console.log(typeof json, json))

        // .then(response => response.blob())
        // .then(blob => console.log(typeof blob, blob))
    })
    .catch(error => console.log(error));
}

function getDocuments(argument) {
    fetch(`${storesApi}/${storeUuid}/documents`, getInit)
    // .then(response => console.log(response))
    .then(response => response.json())
    .then(json => { let documents = json;
        console.log(documents)
    })
    .then(success => console.log(success))
    .catch(error => console.log(error));
}

*/
