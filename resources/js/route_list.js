import Admin from './components/AdminIndex.vue'
import Admins from './components/Admins.vue'
import Teachers from './components/Teachers.vue'
import Students from './components/Students.vue'
import Subjects from './components/Subjects.vue'
import Classrooms from './components/Classrooms.vue'
import Classlist from './components/Classlist.vue'
import Timetables from './components/Timetables.vue'
import Form from './components/Form.vue'
import Term from './components/Terms.vue'
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
    },
    {
        path:'/subjects',
        name: 'addSubject',
        component: Subjects
    },
    {
        path:'/timetables',
        name: 'timeTables',
        component: Timetables
    },
    {
        path:'/term',
        name: 'term',
        component: Term
    },

    {
        path:'/classlist/:id',
        name: 'classList',
        props:true,
        component: Classlist
    }

]
