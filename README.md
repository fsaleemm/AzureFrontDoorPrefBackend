[![Deploy to Azure](https://aka.ms/deploytoazurebutton)](https://portal.azure.com/#create/Microsoft.Template/uri/https%3A%2F%2Fraw.githubusercontent.com%2Ffsaleemm%2FAzureFrontDoorPrefBackend%2Fmain%2Ftemplates%2Fazuredeploy.json)

# Azure Front Door Specify Preferred Region

This is a reference deployment of two Web Apps in different regions and Azure Front Door to route traffic to a preferred Web App region using the AFD Rules Engine. The use case is if you have an operational need to route a portion of production traffic to a speicfic preferred region. Perhaps you are introducing a new feature and need to test the adoption with a subset of users before rolling out to all users. Another use case is, if you have a stateful application and would like to drain the sessions from an existing legacy Web application instance to new upgraded Web application instance without any disruption to your end users. 

# Demo Components

The following components will be deployed to your resource group.

![Components Deployed](/images/comp.PNG)

A rules engine is deployed to the AFD with the following logic:
![](/images/rulesengineconfig.PNG)

# Setup Steps

1. Click the Deploy to Azure button to deploy the components to your resource group. Provide appropriate names for the two WebApps, two App Service Plans, and Azure Front Door. For region, select any of the US regions as the Web Apps get deployed to Cental US and West US. 
1. Go to the resource group and select the Azure Front Door resource.
1. Under Settings, select Front Door designer.
1. In the Routing Rules section, select the Default rule.
![](/images/rule.PNG)
1. In the Route Details section, select the Rules engine configurations dropdown. From the dropdown, select PreferBackend1. Click Update and then Save.
![](images/rulesengineselect.PNG)

# Testing

Use a tool like Postman to submit requests to the Azure Front Door to test the routing based on x-pref-backend request header.

1. Launch Postman tool, and type in the URL of the Azure Fron Door to send a Get request. 
1. Notice the response back from the AFD. It should be the AppName2 you specified during deployment.
1. Add in the request header x-pref-backend and set the value to backend1. Submit the request.
1. Notice the response back from the AFD. It should be the AppName1 you specified during deployment.

By adding in the x-pref-backend heard to the request, we are able to route the traffic to the preferred backend configured in the AFD.