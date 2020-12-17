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
        }
    }
});

export default inviteSlice.reducer;
