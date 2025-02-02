import {ref} from "vue";
import {rand} from "@vueuse/core";

const Products = ref([
    {
        name: "امامکتین امامکتیناما مکتینامامکتینام امکتین",
        price: 200000,
        count: 1,
        description: "این حشره کشه",
        picture: "/images/products/Emamectin.jpg",
    },
    {
        name: "علیرضا",
        price: 100000,
        count: 1,
        description: "آق مهندس علیرضا هستم نویسنده این پروژهآق مهندس علیرضا هستم نویسنده این پروژه",
        picture: "images/products/10640410.webp",
    },
    {
        name: "علف کش",
        price: 500000,
        count: 1,
        description: "مناسب همه نوع علف",
        picture: "/images/products/Emamectin.jpg",
    },
    {
        name: "Products",
        price: 100000,
        count: 10,
        description: "علف کش",
        picture: "/images/products/Emamectin.jpg",
    },
    {
        name: "Products",
        price: 1000,
        count: 100,
        description: "علف کش",
        picture: "images/products/10640410.webp",
    },
]);
const Transaction = ref([
    {
        status: "موفق",
        description: "این حشره کشه",
        date: '1404/11/10',
        price: rand(10, 1000000),
    },
    {
        status: "ناموفق",
        description: "علف کش , بوته توت فرنگی ,بذر خیار,علف کش , بوته توت فرنگی ,بذر خیار,علف کش , بوته توت فرنگی ",
        date: '1402/08/09',
        price: rand(10, 1000000),
    },
    {
        status: "ناموفق",
        description: "این حشره کشه",
        date: '1402/08/09',
        price: rand(10, 1000000),
    },
    {
        status: "ناموفق",
        description: ",بذر خیار,علف کش , بوته توت فرنگی ,بذر خیار,علف کش , بوته توت فرنگی ",
        date: '1404/11/10',
        price: rand(10, 1000000),
    },
    {
        status: "موفق",
        description: ",بذر خیار,علف کش , بوته توت فرنگی ,بذر خیار,علف کش ",
        date: '1402/01/05',
        price: rand(10, 1000000),
    },
    {
        status: "موفق",
        description: ", بوته توت فرنگی ",
        date: '1402/11/01',
        price: rand(10, 1000000),
    },
]);
const Payments = ref([
    {
        level: rand(0, 3),
        product: [
            {
                name: "امامکتین امامکتینامام کتینام امکتینا مامکتین",
                price: 200000,
                count: 1,
                description: "این حشره کشه",
                picture: "/images/products/Emamectin.jpg",
            },
            {
                name: "امامکتین امامکتی نامامک تینامامکتین امامکتین",
                price: 200000,
                count: 1,
                description: "این حشره کشه",
                picture: "/images/products/Emamectin.jpg",
            },
        ],
    },
    {
        level: rand(1, 3),
        product: Products
    },
    {
        level: rand(1, 3),
        product: [{

            name: "امامکتین امامکتی نامامکتینامامکت یناما مکتین",
            price: 200000,
            count: 1,
            description: "این حشره کشه",
            picture: "/images/products/Emamectin.jpg",
        }],
    },
    {
        level: rand(1, 3),
        product: [{

            name: "امامکتین امامکتینا مامکتینام امکتیناما مکتین",
            price: 200000,
            count: 1,
            description: "این حشره کشه",
            picture: "/images/products/Emamectin.jpg",
        }],
    },
    {
        level: rand(1, 3),
        product: [{

            name: "امامکتین امامک تینامام کتینامامکت ینامامکتین",
            price: 200000,
            count: 1,
            description: "این حشره کشه",
            picture: "/images/products/Emamectin.jpg",
        }],
    },
    {
        level: rand(1, 3),
        product: [{

            name: "امامکتین امامکتی نامامکتینام امکتینام امکتین",
            price: 200000,
            count: 1,
            description: "این حشره کشه",
            picture: "/images/products/Emamectin.jpg",
        }],
    },
]);
const LikedProducts = ref(Products);
const productCountIncrement = (index) => {
    Products.value[index].count++;
}
const productCountDecrement = (index) => {
    Products.value[index].count > 0 ? Products.value[index].count-- : Products.value[index].count;
}



export {
    Products,
    productCountIncrement,
    productCountDecrement,
    Transaction,
    Payments,
    LikedProducts,
}
