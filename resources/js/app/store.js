import { configureStore } from '@reduxjs/toolkit';
import { reducer as formReducer } from 'redux-form';
import campaignReducer from '../slices/campaignsSlice';

export default configureStore({
    reducer: {
        form: formReducer,
        campaign: campaignReducer
    }
});
