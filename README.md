# Demo Azure SignalR Fail-over

This is a demo of creating a SignalR application that uses the Azure SignalR service. The demo contains 2 folders, both folders have the same application code to run locally to test the cross region fail-over [scenario](https://docs.microsoft.com/en-us/azure/azure-signalr/signalr-howto-scale-multi-instances#configuration-in-cross-region-scenarios).

## Setup

- Requires Visual Studio Code.
- Provision two SignalR Services: Use the steps documented [here](https://docs.microsoft.com/en-us/azure/azure-signalr/signalr-quickstart-dotnet-core#create-an-azure-signalr-resource) to create an Azure SignalR Service in Azure Portal.

## Setup Connection to Azure SignalR Service

In VS Code open a terminal window and setup the connection below:

In the demo1 folder setup the configurations

```
cd demo1/ChatRoom
dotnet user-secrets init
dotnet user-secrets set Azure:SignalR:ConnectionString:serviceprimary:primary "<your connection string to SERVICE 1>"
dotnet user-secrets set Azure:SignalR:ConnectionString:servicebackup:secondary "<your connection string to SERVICE 2>"
dotnet restore
dotnet run
```

Open another terminal window.
In the demo2 folder setup the configurations, remember to interchange the primary and secondary service connection strings.

```
cd demo2/ChatRoom
dotnet user-secrets init
dotnet user-secrets set Azure:SignalR:ConnectionString:serviceprimary:primary "<your connection string to SERVICE 2>"
dotnet user-secrets set Azure:SignalR:ConnectionString:servicebackup:secondary "<your connection string to SERVICE 1>"
dotnet restore
dotnet run
```

More on disaster recovery configuration details [here](https://docs.microsoft.com/en-us/azure/azure-signalr/signalr-concept-disaster-recovery#through-config).

The server-side connection logs should look similar as below, left screen is in demo1/ChatRoom folder and right screen is in demo2/ChatRoom folder.

![Run Output](/images/ss1.PNG)

## Launch Client Application and Test Fail-Over

- In browser window, open developer tools (e.g. in Chrome F12), then launch demo1 app http://localhost:5000. 
  - Type in a username for the chat room (e.g. user 1).
- In another browser window, open developer tools (e.g. in Chrome F12), then launch demo2 app http://localhost:5002. 
  - Type in a username for the chat room (e.g. user 2).

You will see as below, left screen is demo1 app and right screen is demo2 app:

![Client Windows](/images/ss2.PNG)

The clients connect to their respective primary SignalR service. Demo1 client connects to demo1 and Demo2 client connects to demo2 SignalR service.

Go to Azure Portal and restart demo1 SignalR service. The Demo1 client will reconnect to secondary SignalR service demo2 and chat operations will continue working.

![Failover](/images/ss3.PNG)