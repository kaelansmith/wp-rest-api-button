import { PluginMoreMenuItem } from '@wordpress/edit-post';
import { link } from '@wordpress/icons';
import { withSelect } from '@wordpress/data';
import { registerPlugin } from '@wordpress/plugins';

const OpenPostEndpointButton = withSelect((select) => {
  const postType = select('core/editor').getCurrentPostType();
  const entityRecords = select('core').getEntityRecords('postType', postType, { context: 'view' })
  // console.log('entityRecords: ', entityRecords)
  if (!entityRecords) {
    return {};
  }
  const endpoint = entityRecords[0]._links.self[0].href;

  return {
    endpoint,
  };
})(({ endpoint }) => {
  if(endpoint) {
    return (
      <PluginMoreMenuItem
        icon={link}
        onClick={() => {
          window.open(endpoint, '_blank');
        }}
      >
        View REST API
      </PluginMoreMenuItem>
    );
  }
  return <></>
});

registerPlugin( 'rest-api-button', { render: OpenPostEndpointButton } );
