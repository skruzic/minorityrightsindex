import { configureStore, getDefaultMiddleware } from '@reduxjs/toolkit';
import { reducer as formReducer } from 'redux-form';
import logger from 'redux-logger';
import campaignReducer from '../slices/campaignsSlice';
import inviteReducer from '../slices/inviteSlice';
import pageReducer from '../slices/pagesSlice';

export default configureStore({
    reducer: {
        form: formReducer,
        campaign: campaignReducer,
        invite: inviteReducer,
        page: pageReducer
    },
    middleware: [logger, ...getDefaultMiddleware()]
});
