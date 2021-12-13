import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';
import api from '../app/api';

export const fetchCampaignBySlug = createAsyncThunk(
    'campaigns/fetchBySlugStatus',
    async (slug, thunkAPI) => {
        const response = await api.get(`/campaign/slug/${slug}`);

        return response.data;
    }
);

export const fetchCampaignByToken = createAsyncThunk(
    'campaigns/fetchByTokenStatus',
    async (token, thunkAPI) => {
        const response = await api.get(`/campaign/token/${token}`);

        return response.data;
    }
);

export const saveCampaignAnswers = createAsyncThunk(
    'campaigns/saveAnswersStatus',
    async (formValues, thunkAPI) => {
        const response = await api.post('/campaign', formValues);

        return response.data;
    }
);

export const campaignsSlice = createSlice({
    name: 'campaigns',
    initialState: {
        data: {},
        loading: 'pending',
        error: null,
        preview: false,
        visitedPages: []
    },
    reducers: {
        setPreview(state, action) {
            state.preview = action.payload;
        },
        updateVisitedPages(state, { payload: { direction, value } }) {
            direction > 0
                ? state.visitedPages.push(value)
                : state.visitedPages.splice(-1, 1);
        }
    },
    extraReducers: {
        [fetchCampaignBySlug.pending]: (state, action) => {
            state.loading = 'pending';
        },
        [fetchCampaignBySlug.fulfilled]: (state, action) => {
            state.loading = 'idle';
            state.data = action.payload;
        },
        [fetchCampaignBySlug.rejected]: (state, action) => {
            state.loading = 'idle';
            state.data = {};
            state.error = action.error.message;
        },
        [fetchCampaignByToken.pending]: (state, action) => {
            state.loading = 'pending';
        },
        [fetchCampaignByToken.fulfilled]: (state, action) => {
            state.loading = 'idle';
            state.data = action.payload;
        },
        [fetchCampaignByToken.rejected]: (state, action) => {
            state.loading = 'idle';
            state.data = {};
            state.error = action.error.message;
        }
    }
});

export default campaignsSlice.reducer;

export const { setPreview, updateVisitedPages } = campaignsSlice.actions;
