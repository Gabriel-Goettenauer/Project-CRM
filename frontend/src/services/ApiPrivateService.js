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
    export const getFunnelsShow =async(id)=>{
        return await http.get(`funnels/${id}/show`)
    }
    export const getFunnels = async(id) =>{
        return await http.get(`funnels/${id}`,id)
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
        return await http.put(`contacts/StageUpdate/${id}`,card)
    }
    export const updateContactPosition = async(id,position)=>{
        return await http.put(`contacts/PositionUpdate/${id}`,position)
    }
    export const postContact = async(card) =>{
        return await http.post ('contacts',card)
    }
    export const getUser = async(id) =>{
        return await http.get(`user/${id}`)
    }
export default http;