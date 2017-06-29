{*
 +--------------------------------------------------------------------+
 | CiviCRM version 4.6                                                |
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC (c) 2004-2015                                |
 +--------------------------------------------------------------------+
 | This file is a part of CiviCRM.                                    |
 |                                                                    |
 | CiviCRM is free software; you can copy, modify, and distribute it  |
 | under the terms of the GNU Affero General Public License           |
 | Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
 |                                                                    |
 | CiviCRM is distributed in the hope that it will be useful, but     |
 | WITHOUT ANY WARRANTY; without even the implied warranty of         |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
 | See the GNU Affero General Public License for more details.        |
 |                                                                    |
 | You should have received a copy of the GNU Affero General Public   |
 | License and the CiviCRM Licensing Exception along                  |
 | with this program; if not, contact CiviCRM LLC                     |
 | at info[AT]civicrm[DOT]org. If you have questions about the        |
 | GNU Affero General Public License or the licensing of CiviCRM,     |
 | see the CiviCRM license FAQ at http://civicrm.org/licensing        |
 +--------------------------------------------------------------------+
*}

{if $rows.values}
  <div id="memberships">
    {strip}
      <h3>Membership Terms or Periods</h3>
      <span><strong>Start date: {$membership_start|date_format}</strong></span><br>
      <span><strong>End date: {$membership_end|date_format}</strong></span><br>
      <table id="options" class="display">
        <thead>
        <tr>
          <th style="text-align: center;" width="15%">{ts}Num of Terms{/ts}</th>
          <th style="text-align: center;">{ts}Start Date{/ts}</th>
          <th style="text-align: center;">{ts}End Date{/ts}</th>
          <th width="10%"></th>
        </tr>
        </thead>
        {foreach from=$rows.values item=row}
          <tr id="terms-{$row.id}" class="crm-entity">
            <td class="center">{$row.nth_term}</td>
            <td class="center">{$row.start_date|date_format}</td>
            <td class="center">{$row.end_date|date_format}</td>
            <td class="right">
              <span>
                <a href='{crmURL p='civicrm/contact/view/membership' q="action=view&id=`$row.membership_id`&cid=`$contact_id`&reset=1&context=membership&selectedChild=member"}' class="action-item crm-hover-button">
                  {ts}View Membership{/ts}
                </a>
              </span>
            </td>
          </tr>
        {/foreach}
      </table>
    {/strip}
  </div>
{else}
  <div class="messages status no-popup">
    <div class="icon inform-icon"></div>
    {ts}There are no membership terms for this contact.{/ts}
  </div>
{/if}
