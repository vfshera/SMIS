import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios'

Vue.use(Vuex)

export default  new Vuex.Store({
    state: {
       currentUser: [],
    },
    getters:{
        getCurrentUser(state){
            return state.currentUser;
        }
    },
    mutations: {
        loadUser(state,user) {
            state.currentUser = user;
        }
    },
    actions: {
        fetchUser(context){
            axios.get('/api/user')
                .then(r => r.data)
                .then(user => {
                    context.commit('loadUser',user);
                })

        }
    }
})

