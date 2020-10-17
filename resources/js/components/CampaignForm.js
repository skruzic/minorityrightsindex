import React from 'react';
import PropTypes from 'prop-types';
import { reduxForm } from 'redux-form';
import { withStyles } from '@material-ui/core';
import { compose } from 'redux';
import StepWizard from 'react-step-wizard';
import Question from '../containers/Question';
import Button from '@material-ui/core/Button';
import { isEmpty } from 'lodash';

const CampaignForm = ({ handleSubmit, saveFn, campaign, classes, page }) => {
    const onSubmit = (formValues) => {
        saveFn({
            campaign_id: campaign.id,
            data: formValues,
        });
    };

    return (
        <form onSubmit={handleSubmit(onSubmit)}>
            <StepWizard>
                {campaign.questions.map((q, idx) => (
                    <Question
                        key={q.id}
                        question={{ ...q, step: idx + 1 }}
                        conditionalJump={
                            !isEmpty(q.conditions) &&
                            campaign.questions.indexOf(
                                campaign.questions.find((item) => {
                                    return (
                                        item.id ===
                                        parseInt(q.conditions[0].question_id)
                                    );
                                })
                            ) + 1
                        }
                    />
                ))}
            </StepWizard>
            {/*<Button
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
            </Button>*/}
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
