import {
    createSlice,
    createAsyncThunk,
    createEntityAdapter
} from '@reduxjs/toolkit';
import api from '../app/api';

export const fetchCampaignById = createAsyncThunk(
    'campaigns/fetchByIdStatus',
    async (slug, thunkAPI) => {
        const response = await api.get(`/campaign/${slug}`);

        return response.data;
    }
);

export const campaignsAdapter = createEntityAdapter();

const initialState = campaignsAdapter.getInitialState();

export const campaignsSlice = createSlice({
    name: 'campaigns',
    initialState,
    reducers: {},
    extraReducers: builder => {
        builder.addCase(
            fetchCampaignById.fulfilled,
            campaignsAdapter.upsertOne
        );
    }
});

export default campaignsSlice.reducer;

export const { selectById: selectCampaignById } = campaignsAdapter.getSelectors(
    state => state.campaign
);
