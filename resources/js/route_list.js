import Admin from './components/AdminIndex.vue'
import Admins from './components/Admins.vue'
import Teachers from './components/Teachers.vue'
import Students from './components/Students.vue'
import Classrooms from './components/Classrooms.vue'
import Form from './components/Form.vue'
import formStream from './components/stream.vue'

export const routes = [
    {
        path:'/home',
        component: Admin,
    },
    {
        path:'/root-users',
        name: 'admins',
        component: Admins,
    },
    {
        path:'/teachers',
        name: 'allTeachers',
        component: Teachers
    },
    {
        path:'/students',
        name: 'allStudents',
        component: Students
    },
    {
        path:'/form',
        name: 'addForm',
        component: Form
    },
    {
        path:'/stream',
        name: 'addStream',
        component: formStream
    },
    {
        path:'/classes',
        name: 'addClass',
        component: Classrooms
    }

]
