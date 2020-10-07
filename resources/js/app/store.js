import { configureStore } from "@reduxjs/toolkit";
import campaignReducer from '../slices/campaignSlice'

export default configureStore({
    reducer: {
        campaign: campaignReducer,
    }
})
