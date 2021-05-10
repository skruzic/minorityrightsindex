import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';
import api from '../app/api';

export const fetchPageBySlug = createAsyncThunk(
    'pages/fetchBySlugStatus',
    async (slug, thunkApi) => {
        const response = await api.get(`/page/${slug}`);

        return response.data;
    }
);

export const pagesSlice = createSlice({
    name: 'pages',
    initialState: { data: {}, loading: 'pending', error: null },
    reducers: {},
    extraReducers: {
        [fetchPageBySlug.pending]: (state, action) => {
            state.loading = 'pending';
        },
        [fetchPageBySlug.fulfilled]: (state, action) => {
            state.loading = 'idle';
            state.data = action.payload;
        },
        [fetchPageBySlug.rejected]: (state, action) => {
            state.loading = 'idle';
            state.data = {};
            state.error = action.error.message;
        }
    }
});

export default pagesSlice.reducer;
