import Admin from './components/AdminIndex.vue'
import Admins from './components/Admins.vue'
import Teachers from './components/Teachers.vue'
import Students from './components/Students.vue'

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
    }

]
