import { configureStore, getDefaultMiddleware } from '@reduxjs/toolkit';
import { reducer as formReducer } from 'redux-form';
import logger from 'redux-logger';
import campaignReducer from '../slices/campaignsSlice';
import inviteReducer from '../slices/inviteSlice';

export default configureStore({
    reducer: {
        form: formReducer,
        campaign: campaignReducer,
        invite: inviteReducer
    },
    //middleware: [logger, ...getDefaultMiddleware()]
    middleware: getDefaultMiddleware()
});
