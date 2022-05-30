const home = () =>import ( '../components/Home.vue')

export default [
    {
        path: '/',
        component: home,
        name: 'home',
    },
]