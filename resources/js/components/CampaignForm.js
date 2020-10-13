import React from 'react';
import PropTypes from 'prop-types';
import { reduxForm } from 'redux-form';
import { withStyles } from '@material-ui/core';
import { compose } from 'redux';
import Question from './Question';
import Button from '@material-ui/core/Button';

const CampaignForm = ({ handleSubmit, saveFn, campaign, classes }) => {
    const onSubmit = (formValues) => {
        saveFn({
            campaign_id: campaign.id,
            data: formValues,
        });
    };

    return (
        <form onSubmit={handleSubmit(onSubmit)}>
            {campaign.questions.map((q) => (
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
};

CampaignForm.propTypes = {
    saveFn: PropTypes.func.isRequired,
    campaign: PropTypes.object.isRequired,
};

const styles = (theme) => ({
    button: {
        marginLeft: theme.spacing(3),
    },
});

export default compose(
    reduxForm({ form: 'campaignForm' }),
    withStyles(styles, { withTheme: true })
)(CampaignForm);
