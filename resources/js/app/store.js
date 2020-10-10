import { configureStore, getDefaultMiddleware } from '@reduxjs/toolkit';
import { reducer as formReducer } from 'redux-form';
import logger from 'redux-logger';
import campaignReducer from '../slices/campaignsSlice';

export default configureStore({
    reducer: {
        form: formReducer,
        campaign: campaignReducer,
    },
    middleware: [logger, ...getDefaultMiddleware()],
});
