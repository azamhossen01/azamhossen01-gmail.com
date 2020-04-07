import Vue from 'vue';
import Vuex from 'vuex';
import Axios from 'axios';
Vue.use(Vuex);

const store = new Vuex.Store({
    state : {
        examDetails : []
    },
    getters : {
        examDetails(state){
            return state.examDetails;
        }
    },
    actions : {
        examDetails(context,exam_id){
            Axios.get('exam_details/'+exam_id)
            .then((res)=>{
                console.log(res.data);
                context.commit('examDetails',res.data);
            });
        }
    },
    mutations : {
        examDetails(state,payload){
            return state.examDetails = payload
        }
    }
});

export default store;