import axios from "axios";

const http = axios.create({
    baseURL: "http://localhost:8000/api/",
    headers: {
        "Content-type": "application/json",
    },
});


http.interceptors.request.use(config => {
    const token = localStorage.getItem('token');
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
    }, error => {
    return Promise.reject(error);
});

    export const getFunnels = async() =>{
        return await http.get('funnels')
    }
    export const deleteFunnel = async(id) =>{
        return await http.delete(`/funnels/${id}`)
    }
    export const postFunnel = async(funnel) =>{
        return await http.post('funnels',funnel)
    }
    export const updateFunnel = async(id,funnel) =>{
        return await http.put(`/funnels/${id}`,funnel)
    }
    export const getTables = async(id) =>{
        return await http.get(`stages/${id}/all`)
    }
    export const getContacts = async() =>{
        return await http.get('contacts/all')
    }
    export const postStage = async(stage) =>{
        return await http.post('stages',stage)
    }
    export const updateContactStage = async(id,card) =>{
        return await http.put(`contacts/stage/${id}`,card)
    }
    export const updateContactPosition = async(id,position)=>{
        return await http.put(`contacts/position/${id}`,position)
    }
    export const postContact = async(card) =>{
        return await http.post ('contacts',card)
    }
export default http;