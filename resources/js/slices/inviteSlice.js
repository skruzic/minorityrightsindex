import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';
import api from '../app/api';

export const fetchInviteByToken = createAsyncThunk(
    'invite/fetchByTokenStatus',
    async (token, thunkAPI) => {
        const response = await api.get(`/campaign/token/${token}`);

        return response.data;
    }
);

export const inviteSlice = createSlice({
    name: 'invite',
    initialState: { data: {}, loading: 'pending', error: null },
    reducers: {},
    extraReducers: {
        [fetchInviteByToken.fulfilled]: (state, action) => {
            state.loading = 'idle';
            state.data = action.payload;
        }
    }
});

export default inviteSlice.reducer;
