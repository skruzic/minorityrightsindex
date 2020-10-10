import React, { Component } from 'react';
import { withStyles } from '@material-ui/core';
import { connect } from 'react-redux';
import { reduxForm, Field } from 'redux-form';
import { compose } from 'redux';
import {
    fetchCampaignById,
    selectCampaignById,
} from '../slices/campaignsSlice';
import Card from '@material-ui/core/Card';
import RadioQuestion from '../components/RadioQuestion';
import CheckboxQuestion from '../components/CheckboxQuestion';
import TextQuestion from '../components/TextQuestion';
import Question from '../components/Question';
import Button from '@material-ui/core/Button';

class Campaign extends Component {
    componentDidMount() {
        this.props.fetchCampaignById(6);
    }

    onSubmit(formValues) {
        console.log(formValues);
    }

    render() {
        const { campaign, handleSubmit, classes } = this.props;

        return (
            <form onSubmit={handleSubmit(this.onSubmit)}>
                {campaign &&
                    campaign.questions.map((q) => (
                        <Question key={q.id} question={q} />
                    ))}
                <Button
                    variant="contained"
                    color="primary"
                    type="submit"
                    className={classes.button}
                >
                    Save & continue later
                </Button>
                <Button
                    variant="contained"
                    color="primary"
                    type="submit"
                    className={classes.button}
                >
                    Save & finish
                </Button>
            </form>
        );
    }
}

const styles = (theme) => ({
    button: {
        marginLeft: theme.spacing(3),
    },
});

const mapStateToProps = (state) => {
    return {
        campaign: selectCampaignById(state, 6),
    };
};

export default compose(
    withStyles(styles, { withTheme: true }),
    reduxForm({ form: 'campaignForm' }),
    connect(mapStateToProps, { fetchCampaignById })
)(Campaign);
