const city = () =>import ( '../components/City.vue')

export default [
    {
        path: '/:city',
        component: city,
        name: 'city',
    },
]