import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);
import Signup from './components/Signup.vue';
import Home from './components/Home.vue';
import Exam from './components/Exam.vue';
import ExamDetail from './components/ExamDetail.vue';
const routes = [
    {
        path : '/',
        component : Home
    },
    {
        path : '/exam',
        component : Exam
    },
    {
        path : '/exam_detail/:exam_id',
        component : ExamDetail
    }
]

const router = new VueRouter({
    routes,
    mode:'history'
})
export default router