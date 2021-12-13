import React, { Component } from 'react';
import { withStyles } from '@material-ui/core';
import { connect } from 'react-redux';
import { compose } from 'redux';
import { fetchCampaignBySlug, setPreview } from '../slices/campaignsSlice';
import CircularProgress from '@material-ui/core/CircularProgress';
import CampaignForm from '../components/CampaignForm';
import CampaignHeader from '../components/CampaignHeader';
import ErrorMessage from '../errors/ErrorMessage';

class CampaignPreview extends Component {
    componentDidMount() {
        this.props.fetchCampaignBySlug(this.props.match.params.slug);
        this.props.setPreview(true);
    }

    render() {
        const { campaign, classes, error, loading } = this.props;

        if (loading === 'pending') {
            return <CircularProgress />;
        } else if (error) {
            return <ErrorMessage message={error.message} />;
        } else {
            return (
                <div className={classes.root}>
                    <CampaignHeader title={campaign.title} />
                    <CampaignForm campaign={campaign} saveFn={null} page={1} />
                </div>
            );
        }
    }
}

const mapStateToProps = state => {
    return {
        loading: state.campaign.loading,
        campaign: state.campaign.data
    };
};

const styles = theme => ({
    root: {
        margin: theme.spacing(3)
    }
});

export default compose(
    withStyles(styles, { withTheme: true }),
    connect(mapStateToProps, {
        fetchCampaignBySlug,
        setPreview
    })
)(CampaignPreview);
