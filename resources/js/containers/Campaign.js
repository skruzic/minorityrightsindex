import React, { Component } from 'react';
import { connect } from 'react-redux';
import {
    fetchCampaignBySlug,
    fetchCampaignByToken,
    saveCampaignAnswers,
} from '../slices/campaignsSlice';
import queryString from 'query-string';
import CircularProgress from '@material-ui/core/CircularProgress';
import CampaignForm from '../components/CampaignForm';

class Campaign extends Component {
    componentDidMount() {
        const qs = queryString.parse(this.props.location.search);

        if (qs.token) {
            this.props.fetchCampaignByToken(qs.token);
        } else {
            this.props.fetchCampaignBySlug(this.props.match.params.slug);
        }
    }

    render() {
        const { campaign } = this.props;

        if (this.props.loading === 'pending') {
            return <CircularProgress />;
        } else if (this.props.error) {
            return <h1>Došlo je do greške</h1>;
        }

        return (
            <CampaignForm
                campaign={campaign}
                saveFn={this.props.saveCampaignAnswers}
            />
        );
    }
}

const mapStateToProps = (state) => {
    return {
        loading: state.campaign.loading,
        error: state.campaign.error,
        campaign: state.campaign.data,
    };
};

export default connect(mapStateToProps, {
    fetchCampaignBySlug,
    fetchCampaignByToken,
    saveCampaignAnswers,
})(Campaign);
