import { configureStore } from '@reduxjs/toolkit';
import campaignReducer from '../slices/campaignsSlice';

export default configureStore({
    reducer: {
        campaign: campaignReducer
    }
});
