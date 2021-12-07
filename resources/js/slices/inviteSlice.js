import { createAsyncThunk, createSlice } from '@reduxjs/toolkit';
import api from '../app/api';

export const fetchInviteByToken = createAsyncThunk(
    'invite/fetchByTokenStatus',
    async (token, { rejectWithValue }) => {
        try {
            const response = await api.get(`/campaign/token/${token}`);

            return response.data;
        } catch (error) {
            return rejectWithValue(error.response.data);
        }
    }
);

export const fetchInviteWithoutToken = createAsyncThunk(
    'invite/fetchByTokenStatus',
    async (slug, { rejectWithValue }) => {
        try {
            const response = await api.get(`/campaign/slug/${slug}`);

            return response.data;
        } catch (error) {
            return rejectWithValue(error.response.data);
        }
    }
);

export const updateInvite = createAsyncThunk(
    'invite/updateStatus',
    async (args, { rejectWithValue }) => {
        try {
            const response = await api.post('campaign/invite/update', args);

            return response.data;
        } catch (error) {
            return rejectWithValue(error.response.data);
        }
    }
);

export const inviteSlice = createSlice({
    name: 'invite',
    initialState: { data: {}, loading: 'pending', error: null },
    reducers: {},
    extraReducers: {
        [fetchInviteByToken.pending]: (state, action) => {
            state.loading = 'pending';
        },
        [fetchInviteByToken.fulfilled]: (state, action) => {
            state.loading = 'idle';
            state.data = action.payload;
        },
        [fetchInviteByToken.rejected]: (state, action) => {
            state.loading = 'idle';
            state.error = action.payload;
            state.data = {};
        },
        [fetchInviteWithoutToken.fulfilled]: (state, action) => {
            state.loading = 'idle';
            state.data = action.payload;
        },
        [fetchInviteWithoutToken.rejected]: (state, action) => {
            state.loading = 'idle';
            state.error = action.payload;
            state.data = {};
        },
        [updateInvite.fulfilled]: (state, action) => {
            state.data.page = action.payload.page;
            state.data.visitedPages = action.payload.visitedPages;
        }
    }
});

export default inviteSlice.reducer;
